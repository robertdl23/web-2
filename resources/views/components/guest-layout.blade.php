<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Autenticación' }}</title>

  {{-- Fuente + Tailwind (sin Vite) --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script>
    window.tailwind = { theme:{ extend:{ fontFamily:{ sans:['Inter','ui-sans-serif','system-ui'] } } } };
  </script>
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- Tu CSS plano (public/css/app.css) --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  @stack('head')
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased">
  {{-- Fondo suave --}}
  <div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute -top-40 left-1/2 h-[40rem] w-[70rem] -translate-x-1/2 rotate-12 blur-3xl opacity-30
                bg-gradient-to-tr from-[#ff80b5] to-[#9089fc]"></div>
  </div>

  <div class="mx-auto flex min-h-screen max-w-7xl flex-col items-center justify-center px-4">
    {{-- Logo / volver al foro (opcional) --}}
    <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-semibold text-zinc-700">
      <x-forum.logo class="h-6 w-6" />
      <span>Volver al foro</span>
    </a>

    {{-- Card central --}}
    <div class="w-full max-w-md rounded-2xl bg-white/80 p-8 shadow-xl ring-1 ring-zinc-200 backdrop-blur">
      {{ $slot }}
    </div>
  </div>
</body>
</html>
