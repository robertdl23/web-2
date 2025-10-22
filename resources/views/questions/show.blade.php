{{-- resources/views/questions/show.blade.php --}}
<x-forum.layouts.app>

    {{-- Mensaje flash de éxito (por si vienes de crear/editar) --}}
    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-600/10 px-4 py-2 text-sm text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center gap-2 w-full my-8">
        <div>&hearts;</div>

        <div class="w-full">
            <h2 class="text-2xl font-bold md:text-3xl">
                {{ $question->title }}
            </h2>

            <div class="flex justify-between">
                <p class="text-xs text-gray-500">
                    <span class="font-semibold">{{ $question->user->name }}</span> |
                    {{ $question->category->name ?? 'Sin categoría' }} |
                    {{ $question->created_at->diffForHumans() }}
                </p>

                <div class="flex items-center gap-2">
                    @can('update', $question)
                        <a href="{{ route('questions.edit', $question) }}"
                           class="text-xs font-semibold hover:underline">
                            Editar
                        </a>
                    @endcan

                    @can('delete', $question)
                        <form method="POST"
                              action="{{ route('questions.destroy', $question) }}"
                              onsubmit="return confirm('¿Estás seguro de eliminar esta pregunta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="rounded-md bg-red-600 hover:bg-red-500 px-2 py-1 text-xs font-semibold text-white cursor-pointer">
                                Eliminar
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="my-4">
        <p class="text-gray-200 whitespace-pre-line">
            {{ $question->content }}
        </p>

        {{-- Comentarios de la pregunta --}}
        @if($question->comments->isNotEmpty())
            <ul class="my-4 space-y-2">
                @foreach($question->comments as $comment)
                    <li class="flex items-center gap-2">
                        <p class="text-xs bg-white/10 p-4 rounded-md">
                            <span class="text-gray-500">
                                {{ $comment->user->name }} |
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                            <span class="block text-gray-300">
                                {{ $comment->content }}
                            </span>
                        </p>

                        <div>&hearts;</div>
                    </li>
                @endforeach
            </ul>
        @endif

    {{-- Formulario para agregar comentario --}}
<div class="mt-6">
    @auth
        <form method="POST" action="{{ route('comments.store', $question) }}" class="space-y-2">
            @csrf
            <textarea name="content" rows="3"
                      class="w-full rounded-md bg-white/10 text-gray-200 p-3 placeholder-gray-400 focus:outline-none focus:ring focus:ring-indigo-500"
                      placeholder="Escribe un comentario..." required>{{ old('content') }}</textarea>
            @error('content')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="px-3 py-1.5 rounded-md bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold">
                Comentar
            </button>
        </form>
    @else
        <p class="text-gray-500 text-sm">
            <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Inicia sesión</a>
            para comentar.
        </p>
    @endauth


    </div>

    {{-- Respuestas --}}
@php
    $answers = $question->answers ?? collect();  // si viene null, colección vacía
@endphp

@if($answers->isNotEmpty())
    <ul class="space-y-4">
        @foreach($answers as $answer)
            <li>
                <div class="flex items-start gap-2">
                    <div>&hearts;</div>
                    <div>
                        <p class="text-sm text-gray-900">{{ $answer->content }}</p>
                        <p class="mt-1 text-xs text-gray-500">
                            Por {{ $answer->user->name ?? 'Anónimo' }}
                            — {{ $answer->created_at?->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-sm text-gray-500">Aún no hay respuestas.</p>
@endif


</x-forum.layouts.app>
