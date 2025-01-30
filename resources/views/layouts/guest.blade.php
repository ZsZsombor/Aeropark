@extends('layouts.admin')

@section('content')
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Register New User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Enter the new user's details to register.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.users.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <div class="relative">
                <x-text-input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="mt-1 block w-full pr-10" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" 
                />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative">
                <x-text-input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="mt-1 block w-full pr-10" 
                    :value="old('email')" 
                    required 
                    autocomplete="email" 
                />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input 
                    id="password" 
                    name="password" 
                    type="password" 
                    class="mt-1 block w-full pr-10" 
                    required 
                    autocomplete="new-password" 
                />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="mt-1 block w-full pr-10" 
                    required 
                    autocomplete="new-password" 
                />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Register User') }}</x-primary-button>
        </div>
    </form>
</section>
@endsection