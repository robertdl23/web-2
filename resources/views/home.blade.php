<x-forum.layouts.home :title="'Foro de programación'">
  <section>
    <div class="mb-6 flex items-center justify-between">
      <h2 class="text-2xl font-bold tracking-tight">Preguntas recientes</h2>
      @auth
        <a href="{{ route('questions.create') }}" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Nueva pregunta</a>
      @endauth
    </div>

    @if($questions->count())
      <ul class="grid gap-4">
        @foreach($questions as $q)
          <li class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between gap-4">
              <div>
                <a href="{{ route('question.show', $q) }}" class="text-lg font-semibold text-gray-900 hover:text-indigo-600">
                  {{ $q->title }}
                </a>
                <p class="mt-1 line-clamp-2 text-sm text-gray-600">{{ $q->content }}</p>
                <div class="mt-3 flex flex-wrap items-center gap-3 text-sm text-gray-500">
                  <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-indigo-700">
                    {{ $q->category?->name ?? 'Sin categoría' }}
                  </span>
                  <span>por <strong class="text-gray-700">{{ $q->user?->name ?? 'Anónimo' }}</strong></span>
                  <span>•</span>
                  <span>{{ $q->created_at->diffForHumans() }}</span>
                </div>
              </div>
              <a href="{{ route('question.show', $q) }}" class="shrink-0 rounded-xl border border-gray-200 px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-50">Ver</a>
            </div>
          </li>
        @endforeach
      </ul>

      <div class="mt-6">
        {{ $questions->links() }}
      </div>
    @else
      <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-10 text-center text-gray-600">
        No hay preguntas todavía. ¡Sé el primero en <a href="{{ route('questions.create') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">preguntar</a>!
      </div>
    @endif
  </section>
</x-forum.layouts.home>
