{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
  <div class="mx-auto w-full max-w-sm">
    <div class="mb-8 text-center">
      <h1 class="text-2xl font-semibold">Iniciar sesión</h1>
      <p class="mt-1 text-sm text-gray-500">Entra para participar en el foro</p>
    </div>

    @if (session('status'))
      <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-700">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="grid gap-5">
      @csrf

      {{-- Email --}}
      <div>
        <label for="email" class="mb-1 block text-sm font-medium">Email</label>
        <input id="email" name="email" type="email" required autofocus
               value="{{ old('email') }}"
               class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
        @error('email')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Password --}}
      <div>
        <div class="mb-1 flex items-center justify-between">
          <label for="password" class="block text-sm font-medium">Contraseña</label>
          @if (Route::has('password.request'))
            <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
              ¿Olvidaste tu contraseña?
            </a>
          @endif
        </div>
        <input id="password" name="password" type="password" required
               class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
        @error('password')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Remember me --}}
      <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="remember" class="rounded border-zinc-300 text-indigo-600 focus:ring-indigo-500">
        <span>Recordarme</span>
      </label>

      <button
        class="mt-2 w-full rounded-lg bg-indigo-600 px-4 py-2.5 font-semibold text-white hover:bg-indigo-500">
        Entrar
      </button>
    </form>

    <p class="mt-6 text-center text-sm">
      ¿No tienes cuenta?
      <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Crear una</a>
    </p>
  </div>
</x-guest-layout>
