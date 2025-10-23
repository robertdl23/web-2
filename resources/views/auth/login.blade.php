<x-guest-layout>
  <h1 class="text-2xl font-semibold mb-6 text-center">Iniciar sesión</h1>

  @if (session('status'))
    <div class="mb-4 rounded-md bg-green-50 p-3 text-sm text-green-700">
      {{ session('status') }}
    </div>
  @endif

  {{-- OJO: POST directo a /login --}}
  <<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
      <label class="block text-sm font-medium mb-1">Email</label>
      <input name="email" type="email" required autofocus
             value="{{ old('email') }}"
             class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
      @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
      <div class="flex items-center justify-between mb-1">
        <label class="block text-sm font-medium">Contraseña</label>
        @if (Route::has('password.request'))
          <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        @endif
      </div>
      <input name="password" type="password" required
             class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
      @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <button class="mt-2 w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-white font-semibold hover:bg-indigo-500">
      Entrar
    </button>
  </form>

  <p class="mt-6 text-center text-sm">
    ¿No tienes cuenta?
    <a href="{{ url('/register') }}" class="text-indigo-600 hover:underline">Crear una</a>
  </p>
</x-guest-layout>
