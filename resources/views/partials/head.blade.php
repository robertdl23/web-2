{{-- resources/views/partials/head.blade.php --}}
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

{{-- Fuentes --}}
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

{{-- Tailwind CDN (sin Vite) --}}
<script>
  window.tailwind = {
    theme: { extend: { fontFamily: { sans: ['Inter','ui-sans-serif','system-ui'] } } }
  }
</script>
<script src="https://cdn.tailwindcss.com"></script>

{{-- Tu CSS plano para overrides (public/css/app.css) --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@stack('head')
