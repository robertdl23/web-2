<x-forum.layouts.home>
    @if (session('success'))
        <div class="mb-4 rounded-md bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold">Preguntas recientes</h2>
        @auth
            <a href="{{ route('questions.create') }}"
               class="rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold">
               Preguntar
            </a>
        @endauth
    </div>

    <div class="space-y-4">
        @forelse ($questions as $q)
            <a href="{{ route('question.show', $q) }}" class="block rounded-lg border p-4 hover:bg-gray-50">
                <h3 class="text-lg font-semibold">{{ $q->title }}</h3>
                <p class="text-sm text-gray-600">
                    {{ $q->category?->name }} • por {{ $q->user?->name }} • {{ $q->created_at->diffForHumans() }}
                </p>
                <p class="mt-2 text-gray-700">
                    {{ \Illuminate\Support\Str::limit($q->content, 160) }}
                </p>
            </a>
        @empty
            <p class="text-gray-600">No hay preguntas aún.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $questions->links() }}
    </div>
</x-forum.layouts.home>
