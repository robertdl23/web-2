<x-forum.layouts.home>
    <div class="mx-auto w-full max-w-3xl">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Preguntas recientes</h1>
                <p class="mt-1 text-sm text-gray-500">Explora lo último de la comunidad.</p>
            </div>
            @auth
                <a href="{{ route('questions.create') }}"
                   class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                    Preguntar
                </a>
            @endauth
        </div>

        @if($categories->count())
            <div class="mb-6 flex flex-wrap gap-2">
                @foreach($categories as $cat)
                    <span class="rounded-full border border-gray-300 bg-white/70 px-3 py-1 text-xs text-gray-700">
                        {{ $cat->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <div class="space-y-4">
            @forelse($questions as $q)
                <a href="{{ route('question.show', $q) }}"
                   class="block rounded-2xl border border-gray-200 bg-white/70 p-4 shadow-sm hover:border-gray-300">
                    <div class="mb-1 text-xs text-gray-500">
                        {{ $q->category?->name ?? 'Sin categoría' }} • por {{ $q->user?->name ?? 'Anónimo' }}
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $q->title }}</h3>
                    <p class="mt-1 line-clamp-2 text-sm text-gray-600">
                        {{ \Illuminate\Support\Str::limit($q->content, 140) }}
                    </p>
                </a>
            @empty
                <p class="text-sm text-gray-500">No hay preguntas aún.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $questions->links() }}
        </div>
    </div>
</x-forum.layouts.home>
