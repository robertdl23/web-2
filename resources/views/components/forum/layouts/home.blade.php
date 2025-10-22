<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foro de programación</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <div class="px-4">
            <x-forum.navbar />
        </div>

        <!-- HERO -->
        <div class="relative flex items-center justify-center py-20">
            <!-- FONDO DECORATIVO: no bloquear clics -->
            <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 transform-gpu blur-3xl sm:-top-80 select-none">
                <div
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36rem] -translate-x-1/2 rotate-[30deg]
                           bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30
                           sm:left-[calc(50%-30rem)] sm:w-[72rem]">
                </div>
            </div>

            <!-- CONTENIDO POR ENCIMA -->
            <div class="max-w-2xl relative z-20">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="rounded-full px-4 py-2 text-sm text-gray-600 border border-gray-300 bg-white/70 backdrop-blur">
                        Resuelve tus preguntas de programación. <a href="#" class="font-semibold text-indigo-600">Acerca de &rarr;</a>
                    </div>
                </div>

                <div class="text-center">
                    <h1 class="text-5xl font-semibold text-gray-900 sm:text-7xl">
                        Bienvenido a tu foro favorito
                    </h1>
                    <p class="my-8 text-lg font-medium text-gray-500 sm:text-xl">
                        Es un espacio para compartir, aprender y crecer en el mundo de la programación.
                        Únete a nuestra comunidad, participa en discusiones y aprende de otros profesionales.
                    </p>

                    <!-- BOTONES: aseguramos que estén por encima -->
                    <div class="relative z-20 flex items-center justify-center gap-6">
                        @auth
                            <a href="{{ route('questions.create') }}"
                               class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500">
                               Preguntar
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500">
                               Preguntar
                            </a>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900">Login →</a>
                        @else
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm font-semibold text-gray-900">Cerrar sesión →</button>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENIDO INTERNO -->
        <div class="mx-auto max-w-4xl px-4 mb-8 w-full">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
