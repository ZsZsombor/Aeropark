<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Airport Worker Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Custom styles for the page */
            body {
                background-color: #f0f0f0;
                font-family: 'Figtree', sans-serif;
            }

            .bg-light-blue {
                background-color: #B5E0F3;
            }

            .bg-dark-blue {
                background-color: #003366;
            }
        </style>
    @endif
</head>

<body class="font-sans antialiased bg-light-blue dark:bg-dark-blue">
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <div class="relative w-full max-w-2xl px-6 py-10">
            <header class="text-center mb-8">
                <h1 class="text-4xl font-semibold text-black">Aeropark Portal</h1>
                <p class="text-black mt-2">Please login as a User or Admin to proceed.</p>
            </header>

            <div id="container">
                <!-- Tab links -->
                <ul class="nav nav-tabs" id="loginTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="adminTab" data-bs-toggle="tab" href="#adminLogin" role="tab" aria-controls="adminLogin" aria-selected="true">User Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="userTab" data-bs-toggle="tab" href="#userLogin" role="tab" aria-controls="userLogin" aria-selected="false">Admin Login</a>
                    </li>
                </ul>
            
                <!-- Tab content -->
                <div class="tab-content mt-3" id="loginTabsContent">
                    <div class="tab-pane fade show active" id="adminLogin" role="tabpanel" aria-labelledby="adminTab">
                        @include('auth.login')
                    </div>
                    <div class="tab-pane fade" id="userLogin" role="tabpanel" aria-labelledby="userTab">
                        @include('admin.auth.login')
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>


<script>
    window.addEventListener("beforeunload", function () {
        navigator.sendBeacon('/destroy-session');
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>
