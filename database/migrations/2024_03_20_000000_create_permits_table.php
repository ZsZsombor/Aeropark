<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('type', ['access_card', 'annual_permit']);
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->timestamp('expiry_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permits');
    }
};