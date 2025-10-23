<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'Foro · Acceso' }}</title>

  <!-- Fuente + Tailwind via CDN -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script>
    window.tailwind = { theme:{ extend:{ fontFamily:{ sans:['Inter','ui-sans-serif','system-ui'] } } } }
  </script>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Tus overrides (sin Vite) -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased">
  <!-- Fondo bonito -->
  <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 transform-gpu blur-3xl sm:-top-80 select-none">
    <div class="relative left-1/2 -translate-x-1/2 aspect-[1155/678] w-[36rem] rotate-[30deg]
                bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:w-[72rem]"></div>
  </div>

  <main class="relative z-10 mx-auto max-w-md px-6 py-16">
    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-10 text-sm text-indigo-600 hover:underline">
      ← Volver al foro
    </a>

    <div class="rounded-2xl bg-white/80 backdrop-blur shadow-xl ring-1 ring-zinc-200 p-8">
      {{ $slot }}
    </div>
  </main>
</body>
</html>
