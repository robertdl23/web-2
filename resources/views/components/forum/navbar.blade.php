<nav class="flex items-center justify-between h-16">
  <div>
    <a href="{{ route('home') }}"><x-forum.logo /></a>
  </div>

  <div class="flex gap-4">
    <a href="{{ route('home') }}" class="text-sm font-semibold">Foro</a>
    <a href="#" class="text-sm font-semibold">Blog</a>
  </div>

  <div class="flex items-center gap-3">
    @auth
      <a href="{{ route('questions.create') }}"
   class="rounded-md bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-indigo-500">
   Preguntar
</a>

      <span class="text-sm text-gray-700">Hola, {{ auth()->user()->name }}</span>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="text-sm font-semibold">Salir</button>
      </form>
    @else
      <a href="{{ route('login') }}" class="text-sm font-semibold">Log in →</a>
      <a href="{{ route('register') }}" class="text-sm font-semibold">Registro</a>
    @endauth
  </div>
</nav>
