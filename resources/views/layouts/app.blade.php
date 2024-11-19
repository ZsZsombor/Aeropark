<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permits System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <a href="{{ route('home') }}" class="py-4 px-2">Home</a>
                    @auth
                        <a href="{{ route('permits.index') }}" class="py-4 px-2">My Permits</a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.permits') }}" class="py-4 px-2">Admin Dashboard</a>
                        @endif
                    @endauth
                </div>
                <div class="flex items-center space-x-3">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="py-2 px-4 bg-blue-500 text-white rounded">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>
</html>