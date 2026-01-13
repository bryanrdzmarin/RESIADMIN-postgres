
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ResiAdmin</title>

    <link rel="icon" type="image/png" href="{{ asset('imagenes/logo4.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="bg-gradient-to-br from-[#f2f4f1] to-[#e6f4f2] dark:from-[#0c0c0c] dark:to-[#141f1e] text-[#1b1b18] dark:text-[#EDEDEC] flex p-6 lg:p-8 items-center justify-center min-h-screen">
   <main class="flex w-full max-w-6xl bg-white dark:bg-[#181818] rounded-lg shadow-lg overflow-hidden lg:h-[70vh] border border-emerald-300 dark:border-emerald-800">
        
        {{-- Panel izquierdo --}}
        <div class="w-full lg:w-1/2 p-8 lg:p-14 flex flex-col justify-center">
            <h1 class="text-3xl lg:text-4xl font-bold mb-4 text-emerald-700 dark:text-emerald-400">
                Bienvenido al Sistema de Gestión de Residencias Universitarias
            </h1>

            <p class="text-lg text-gray-700 dark:text-gray-400 mb-8 leading-relaxed">
                Administra, organiza y supervisa las residencias universitarias de forma práctica, eficiente y centralizada.
            </p>

            <div class="flex justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}">
                        <flux:button variant="primary" class="px-6 py-3 text-lg">Ir al Dashboard</flux:button>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <flux:button variant="primary">Iniciar sesión</flux:button>
                    </a>


                @endauth
            </div>
        </div>

        {{-- Panel derecho con imagen personalizada --}}
        <div class="w-full lg:w-1/2 bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center p-6 lg:p-10">
            <img src="{{ asset('imagenes/logo.jpg') }}"
                 alt="Logo del sistema"
                 class="max-h-80 lg:max-h-96 object-contain drop-shadow-md rounded-xl transition duration-300">
        </div>

    </main>
</body>





</html>