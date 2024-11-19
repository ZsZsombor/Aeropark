@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
        <div class="bg-card rounded-lg shadow-lg border border-border p-6">
            <h1 class="text-2xl font-bold mb-6 text-foreground">Login</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-foreground">Email</label>
                    <input type="email" name="email" class="mt-1 block w-full rounded-md bg-muted border-border text-foreground shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-foreground">Password</label>
                    <input type="password" name="password" class="mt-1 block w-full rounded-md bg-muted border-border text-foreground shadow-sm focus:border-primary focus:ring-primary">
                </div>
                <button type="submit" class="w-full bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded transition-colors">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection