@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4">
    <div class="bg-card rounded-lg shadow-lg border border-border p-6">
        <h1 class="text-2xl font-bold mb-6 text-foreground">Create New User</h1>

        @if ($errors->any())
            <div class="bg-destructive/15 text-destructive p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-foreground mb-1">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-md bg-muted border-border text-foreground shadow-sm focus:border-primary focus:ring-primary p-2"
                    required
                >
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-foreground mb-1">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    value="{{ old('email') }}"
                    class="w-full rounded-md bg-muted border-border text-foreground shadow-sm focus:border-primary focus:ring-primary p-2"
                    required
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-foreground mb-1">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    class="w-full rounded-md bg-muted border-border text-foreground shadow-sm focus:border-primary focus:ring-primary p-2"
                    required
                >
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-secondary text-secondary-foreground rounded-md hover:bg-secondary/90">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection