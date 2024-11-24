@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Management</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            Create User
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="list-group">
                @forelse($users as $user)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="h5 mb-1">{{ $user->name }}</h3>
                            <p class="mb-0 text-muted">{{ $user->email }}</p>
                        </div>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        No users found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection