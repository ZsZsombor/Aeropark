@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-destructive/15 text-destructive px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-foreground">User Management</h1>
        <a href="{{ route('admin.users.create') }}" 
           class="bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded-md transition-colors">
            Create User
        </a>
    </div>

    <div class="bg-card rounded-lg shadow-lg border border-border">
        <div class="p-6">
            <div class="space-y-4">
                @forelse($users as $user)
                    <div class="border border-border rounded-lg p-4 bg-muted flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-foreground">{{ $user->name }}</h3>
                            <p class="text-sm text-muted-foreground">{{ $user->email }}</p>
                        </div>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="flex space-x-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-destructive text-destructive-foreground hover:bg-destructive/90 px-3 py-1 rounded-md text-sm transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted-foreground">
                        No users found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection