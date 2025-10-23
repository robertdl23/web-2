{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
  <div class="mx-auto w-full max-w-sm">
    <div class="mb-8 text-center">
      <h1 class="text-2xl font-semibold">Crear cuenta</h1>
      <p class="mt-1 text-sm text-gray-500">Únete y empieza a preguntar y responder</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="grid gap-5">
      @csrf

      {{-- Name --}}
      <div>
        <label for="name" class="mb-1 block text-sm font-medium">Nombre</label>
        <input id="name" name="name" type="text" required value="{{ old('name') }}"
               class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
        @error('name')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Email --}}
      <div>
        <label for="email" class="mb-1 block text-sm font-medium">Email</label>
        <input id="email" name="email" type="email" required value="{{ old('email') }}"
               class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
        @error('email')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Password --}}
      <div>
        <label for="password" class="mb-1 block text-sm font-medium">Contraseña</label>
        <input id="password" name="password" type="password" required
               class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
        @error('password')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      {{-- Confirm --}}
      <div>
        <label for="password_confirmation" class="mb-1 block text-sm font-medium">Confirmar contraseña</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required
               class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2 outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      {{-- (Opcional) Términos --}}
      <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" required class="rounded border-zinc-300 text-indigo-600 focus:ring-indigo-500">
        <span>Acepto los términos y condiciones</span>
      </label>

      <button
        class="mt-2 w-full rounded-lg bg-indigo-600 px-4 py-2.5 font-semibold text-white hover:bg-indigo-500">
        Crear cuenta
      </button>
    </form>

    <p class="mt-6 text-center text-sm">
      ¿Ya tienes cuenta?
      <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Entrar</a>
    </p>
  </div>
</x-guest-layout>
