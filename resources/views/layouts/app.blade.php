<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <style> 

.home-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url('/images/background.jpg'); /* ✅ Remplace par ton image */
    background-size: cover;
    background-position: center;
}

.login-box {
    width: 350px;
    padding: 30px;
    background: rgba(0, 0, 0, 0.7); /* ✅ Boîte semi-transparente */
    border-radius: 10px;
}

.login-box h2 {
    margin-bottom: 20px;
}

.login-box input {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    border: none;
}

.login-box input::placeholder {
    color: #ddd;
}

.login-box .btn-primary {
    background-color: #007bff;
    border: none;
}

.login-box .btn-outline-light {
    border-color: #fff;
}

     </style>



    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
<main>
    @yield('content') <!-- Cette ligne permet d'afficher le contenu des vues -->
</main>
        </div>




       

    </body>
</html>
