<x-guest-layout>
  <h1 class="mb-6 text-center text-2xl font-semibold">Log in</h1>

  <form method="POST" action="{{ route('login') }}" class="grid gap-4">
    @csrf

    <div>
      <label class="block text-sm font-medium">Email</label>
      <input name="email" type="email" value="{{ old('email') }}" required autofocus
             class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium">Password</label>
      <input name="password" type="password" required
             class="mt-1 w-full rounded-lg border border-zinc-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <button class="mt-2 w-full rounded-lg bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-500">
      Log in
    </button>

    <p class="mt-4 text-center text-sm text-zinc-600">
      Dont have an account?
      <a class="font-semibold text-indigo-600 hover:underline" href="{{ route('register') }}">Sign up</a>
    </p>
  </form>
</x-guest-layout>
