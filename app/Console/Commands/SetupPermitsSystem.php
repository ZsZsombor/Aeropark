<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Permit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetupPermitsSystem extends Command
{
    protected $signature = 'permits:setup';
    protected $description = 'Setup the permits system with initial data';

    public function handle()
    {
        $this->info('Setting up permits system...');

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );
        $this->info('Admin user created: admin@example.com / admin123');

        // Create regular user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]
        );
        $this->info('Regular user created: user@example.com / user123');

        // Create sample permits
        $permitTypes = ['access_card', 'annual_permit'];
        $statuses = ['pending', 'approved', 'rejected'];

        foreach ([$admin, $user] as $u) {
            foreach ($permitTypes as $type) {
                Permit::firstOrCreate([
                    'user_id' => $u->id,
                    'type' => $type,
                    'status' => $statuses[array_rand($statuses)],
                    'expiry_date' => now()->addYear(),
                ]);
            }
        }
        $this->info('Sample permits created');

        $this->info('Setup completed successfully!');
    }
}