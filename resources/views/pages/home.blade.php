<x-forum.layouts.home>
    <div class="space-y-8">
        <h2 class="text-2xl font-bold">Preguntas recientes</h2>

        <ul class="divide-y divide-gray-200">
            @forelse ($questions as $question)
                <li class="py-4">
                    <a href="{{ route('question.show', $question) }}"
                       class="font-semibold hover:underline">
                        {{ $question->title }}
                    </a>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ \Illuminate\Support\Str::limit(strip_tags($question->content), 140) }}
                    </p>
                    <div class="mt-2 text-xs text-gray-500">
                        {{ $question->category->name ?? 'Sin categoría' }} •
                        por {{ $question->user->name ?? 'Anónimo' }}
                    </div>
                </li>
            @empty
                <li class="py-6 text-gray-500">Aún no hay preguntas.</li>
            @endforelse
        </ul>

        {{-- Paginación --}}
        <div>
            {{ $questions->links() }}
        </div>
    </div>
</x-forum.layouts.home>
