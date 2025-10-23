<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? config('app.name', 'Foro') }}</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script>
    window.tailwind = { theme:{ extend:{ fontFamily:{ sans:['Inter','ui-sans-serif','system-ui'] } } } };
  </script>
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  @stack('head')
</head>
<body class="min-h-screen bg-white text-zinc-900 antialiased">
  <header class="px-4 border-b border-zinc-200">
    <x-forum.navbar />
  </header>

  <main class="mx-auto w-full max-w-5xl px-4 py-10">
    {{ $slot }}
  </main>
</body>
</html>
