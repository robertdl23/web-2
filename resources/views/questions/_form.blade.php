{{-- Campos del formulario de Pregunta --}}
{{-- Espera: $categories (pluck id=>name) y $question (modelo o stdClass) --}}

{{-- Categoría --}}
<div>
    <label for="category_id" class="mb-1 block text-sm font-medium text-gray-700">
        Categoría
    </label>
    <select id="category_id" name="category_id"
            class="block w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">— Selecciona —</option>
        @foreach($categories as $id => $name)
            <option value="{{ $id }}" @selected(old('category_id', $question->category_id ?? null) == $id)>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Título --}}
<div>
    <label for="title" class="mb-1 block text-sm font-medium text-gray-700">
        Título
    </label>
    <input id="title" name="title" type="text" placeholder="Ej. ¿Cómo optimizo una consulta Eloquent con relaciones?"
           value="{{ old('title', $question->title ?? '') }}"
           class="block w-full rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500" />
    @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Contenido --}}
<div>
    <label for="content" class="mb-1 block text-sm font-medium text-gray-700">
        Contenido
    </label>
    <textarea id="content" name="content" rows="8"
              placeholder="Describe tu problema, qué intentaste, errores y fragmentos de código relevantes."
              class="block w-full resize-y rounded-xl border-gray-300 bg-white text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $question->content ?? '') }}</textarea>
    @error('content')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Botones --}}
<div class="flex items-center justify-end gap-3 pt-2">
    <a href="{{ route('home') }}"
       class="rounded-xl border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
        Cancelar
    </a>
    <button
        class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Publicar pregunta
    </button>
</div>
