@extends('layouts.admin')

@section('content')
<section class="container mt-5">
    <header>
        <h1 class="text-lg font-medium text-dark">
            {{ __('Register New User') }}
        </h1>

        <p class="mt-2 text-muted">
            {{ __("Enter the new user's details to register.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.users.store') }}" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name') }}" 
                required 
                autofocus 
                autocomplete="name" 
            />
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email') }}" 
                required 
                autocomplete="email" 
            />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input 
                id="password" 
                name="password" 
                type="password" 
                class="form-control @error('password') is-invalid @enderror" 
                required 
                autocomplete="new-password" 
            />
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                required 
                autocomplete="new-password" 
            />
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Register User') }}</button>
        </div>
    </form>
</section>
@endsection
