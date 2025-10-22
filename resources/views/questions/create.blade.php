{{-- resources/views/questions/create.blade.php --}}
<x-forum.layouts.home>
    @php
        // FIX RÁPIDO: trae categorías aquí para pasarlas al partial
        // (mejor práctica: hacerlo en el controlador y pasar $categories desde allí)
        $categories = \App\Models\Category::orderBy('name')->get(['id','name']);
    @endphp

    <div class="mx-auto w-full max-w-3xl">
        <div class="mb-6">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Nueva pregunta</h2>
            <p class="mt-1 text-sm text-gray-500">
                Comparte tu duda con la comunidad. Sé claro y directo en el título.
            </p>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white/70 shadow-sm backdrop-blur">
            <div class="p-6">
                <form method="POST" action="{{ route('questions.store') }}" class="space-y-6">
                    @csrf
                    {{-- Asegúrate de pasar $categories al partial --}}
                    @include('questions._form', [
                        'question'    => new \App\Models\Question(),
                        'categories'  => $categories,
                    ])
                </form>
            </div>
        </div>
    </div>
</x-forum.layouts.home>
