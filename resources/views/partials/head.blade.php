{{-- resources/views/partials/head.blade.php --}}
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>{{ $title ?? 'Foro de programación' }}</title>

{{-- Fuente --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

{{-- Tailwind por CDN (sin Vite) --}}
<script>
  window.tailwind = {
    theme: { extend: { fontFamily: { sans: ['Inter','ui-sans-serif','system-ui'] } } }
  }
</script>
<script src="https://cdn.tailwindcss.com"></script>

{{-- Tus overrides opcionales en public/css/app.css --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<meta name="csrf-token" content="{{ csrf_token() }}">
@stack('head')
