<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permits System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --background: 222.2 84% 4.9%;
            --foreground: 210 40% 98%;
            --card: 222.2 84% 4.9%;
            --card-foreground: 210 40% 98%;
            --popover: 222.2 84% 4.9%;
            --popover-foreground: 210 40% 98%;
            --primary: 221 83% 53%;
            --primary-foreground: 210 40% 98%;
            --secondary: 217.2 32.6% 17.5%;
            --secondary-foreground: 210 40% 98%;
            --muted: 217.2 32.6% 17.5%;
            --muted-foreground: 215 20.2% 65.1%;
            --accent: 217.2 32.6% 17.5%;
            --accent-foreground: 210 40% 98%;
            --destructive: 0 62.8% 30.6%;
            --destructive-foreground: 210 40% 98%;
            --border: 217.2 32.6% 17.5%;
            --input: 217.2 32.6% 17.5%;
            --ring: 221 83% 53%;
        }
    </style>
</head>
<body class="bg-background text-foreground min-h-screen">
    <nav class="bg-card shadow-lg border-b border-border">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <a href="{{ route('home') }}" class="py-4 px-2 text-foreground hover:text-primary transition-colors">Home</a>
                    @auth
                        <a href="{{ route('permits.index') }}" class="py-4 px-2 text-foreground hover:text-primary transition-colors">My Permits</a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.permits') }}" class="py-4 px-2 text-foreground hover:text-primary transition-colors">Admin Dashboard</a>
                        @endif
                    @endauth
                </div>
                <div class="flex items-center space-x-3">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-2 px-4 bg-destructive text-destructive-foreground rounded hover:bg-destructive/90 transition-colors">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="py-2 px-4 bg-primary text-primary-foreground rounded hover:bg-primary/90 transition-colors">Login</a>
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