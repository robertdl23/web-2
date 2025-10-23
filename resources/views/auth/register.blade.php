<x-guest-layout>
  <h1 class="text-2xl font-semibold mb-6 text-center">Crear cuenta</h1>

  {{-- OJO: POST directo a /register --}}
  <form method="POST" action="{{ url('/register') }}" class="grid gap-5">
    @csrf

    <div>
      <label class="block text-sm font-medium mb-1">Nombre</label>
      <input name="name" type="text" required value="{{ old('name') }}"
             class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
      @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Email</label>
      <input name="email" type="email" required value="{{ old('email') }}"
             class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
      @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Contraseña</label>
      <input name="password" type="password" required
             class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
      @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Confirmar contraseña</label>
      <input name="password_confirmation" type="password" required
             class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
    </div>

    <button class="mt-2 w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-white font-semibold hover:bg-indigo-500">
      Crear cuenta
    </button>
  </form>

  <p class="mt-6 text-center text-sm">
    ¿Ya tienes cuenta?
    <a href="{{ url('/login') }}" class="text-indigo-600 hover:underline">Entrar</a>
  </p>
</x-guest-layout>
