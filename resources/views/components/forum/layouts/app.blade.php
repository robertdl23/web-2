<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Foro de programación' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
      window.tailwind = {
        theme: { extend: { fontFamily: { sans: ['Inter','ui-sans-serif','system-ui'] } } }
      }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Tus overrides simples (public/css/app.css) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')
</head>

<body class="min-h-screen bg-white text-gray-900 antialiased">
  <div class="relative flex min-h-screen flex-col">

    {{-- NAVBAR --}}
    <header class="px-4">
      <x-forum.navbar />
    </header>

    {{-- “Hero” corto para páginas internas --}}
    <section class="relative py-10">
      <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 transform-gpu blur-3xl sm:-top-72 select-none">
        <div
          class="relative left-1/2 aspect-[1155/678] w-[36rem] -translate-x-1/2 rotate-[30deg]
                 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:w-[60rem]">
        </div>
      </div>

      <div class="mx-auto max-w-3xl px-4 text-center">
        <h1 class="text-3xl font-semibold sm:text-4xl">Foro</h1>
        <p class="mt-3 text-sm text-gray-500">Comparte tus dudas y ayuda a la comunidad.</p>
      </div>
    </section>

    {{-- CONTENIDO --}}
    <main class="mx-auto mb-12 w-full max-w-3xl px-4">
      <div class="rounded-2xl border border-gray-200 bg-white/80 p-6 shadow-sm backdrop-blur">
        {{ $slot }}
      </div>
    </main>

  </div>
</body>
</html>
