@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-foreground">User Management</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2 rounded transition-colors">
                Create User
            </a>
        </div>

        <div class="bg-card rounded-lg shadow-lg border border-border">
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($users as $user)
                        <div class="border border-border rounded p-4 bg-muted flex justify-between items-center">
                            <div>
                                <h3 class="font-semibold text-foreground">{{ $user->name }}</h3>
                                <p class="text-sm text-muted-foreground">{{ $user->email }}</p>
                            </div>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="flex space-x-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-destructive text-destructive-foreground hover:bg-destructive/90 px-3 py-1 rounded text-sm transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection