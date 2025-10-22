<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Foro de programación</title>

    {{-- Vite (Tailwind + JS) --}}
    @vite('resources/js/app.js')

    {{-- Espacio opcional para inyectar estilos/JS desde vistas hijas --}}
    @stack('head')
</head>
<body class="min-h-screen bg-white text-gray-900 antialiased">
    <div class="relative flex min-h-screen flex-col">
        {{-- NAVBAR --}}
        <header class="px-4">
            <x-forum.navbar />
        </header>

        {{-- HERO --}}
        <section class="relative isolate overflow-hidden py-20">
            {{-- Fondo decorativo (NO bloquea clics) --}}
            <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 select-none blur-3xl sm:-top-80">
                <div
                    class="relative left-1/2 aspect-[1155/678] w-[36rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:w-[72rem]">
                </div>
            </div>

            {{-- Contenido --}}
            <div class="relative z-10 mx-auto max-w-2xl px-4 text-center">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <p class="rounded-full border border-gray-300 bg-white/70 px-4 py-2 text-sm text-gray-600 backdrop-blur">
                        Resuelve tus preguntas de programación.
                        <a href="#" class="font-semibold text-indigo-600">Acerca de →</a>
                    </p>
                </div>

                <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                    Bienvenido a tu foro favorito
                </h1>
                <p class="mt-8 text-lg font-medium text-gray-500 sm:text-xl">
                    Comparte, aprende y crece en el mundo de la programación.
                    Únete a la comunidad, participa en discusiones y aprende de profesionales.
                </p>

                <div class="mt-8 flex items-center justify-center gap-6">
                    @auth
                        <a href="{{ route('questions.create') }}"
                           class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Preguntar
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="text-sm font-semibold text-gray-900 hover:underline">
                                Cerrar sesión →
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Preguntar
                        </a>
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900 hover:underline">
                            Login →
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        {{-- CONTENIDO DE LAS VISTAS --}}
        <main class="mx-auto mb-12 w-full max-w-4xl px-4">
            {{ $slot }}
        </main>

        {{-- Footer opcional --}}
        @isset($footer)
            <footer class="mt-auto border-t border-gray-200 bg-white/70">
                <div class="mx-auto max-w-4xl px-4 py-6">
                    {{ $footer }}
                </div>
            </footer>
        @endisset
    </div>

    @stack('body')
</body>
</html>
