<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans leading-relaxed">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800 hover:text-blue-600">
                Laravel App
            </a>
            <div class="space-x-4">
                <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Sobre</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Contato</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-10">
        <div class="container mx-auto px-6 bg-white shadow-md rounded-lg p-6">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-6">
        <div class="container mx-auto px-6">
            <p class="text-sm text-gray-600">
                © {{ date('Y') }} <span class="font-semibold">Laravel App</span>. Todos os direitos reservados.
            </p>
        </div>
    </footer>

</body>
</html>
