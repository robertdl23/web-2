{{-- resources/views/questions/_form.blade.php --}}
{{-- Requiere: $categories (Collection de Category o pluck id=>name) y $question (modelo o stdClass) --}}

@php
    use App\Models\Category;
    use Illuminate\Support\Collection;

    // Normaliza $categories a un pluck id => name
    $cats = $categories instanceof Collection ? $categories : collect($categories);

    if ($cats->isNotEmpty() && $cats->first() instanceof Category) {
        $cats = $cats->sortBy('name')->pluck('name', 'id');
    } elseif ($cats->isNotEmpty() && ! $cats->keys()->contains(0)) {
        // si ya viene como id=>name lo dejamos tal cual, sólo aseguramos orden
        $cats = $cats->sort();
    }

    // Valor seleccionado: prioridad a old(), si no el del modelo
    $selected = (string) old('category_id', $question->category_id ?? '');
@endphp

{{-- Categoría --}}
<div>
    <label for="category_id" class="mb-1 block text-sm font-medium text-gray-700">
        Categoría
    </label>

    <select
        id="category_id"
        name="category_id"
        required
        aria-required="true"
        @class([
            'block w-full rounded-xl border bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500',
            'border-gray-300' => !$errors->has('category_id'),
            'border-red-500'  =>  $errors->has('category_id'),
        ])
        aria-invalid="{{ $errors->has('category_id') ? 'true' : 'false' }}"
    >
        <option value="">— Selecciona —</option>

        @foreach ($cats as $id => $name)
            @php $id = (string) $id; @endphp
            <option value="{{ $id }}" {{ $selected === $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Título --}}
<div class="mt-4">
    <label for="title" class="mb-1 block text-sm font-medium text-gray-700">
        Título
    </label>

    <input
        id="title"
        name="title"
        type="text"
        required
        placeholder="Ej. ¿Cómo optimizo una consulta Eloquent con relaciones?"
        value="{{ old('title', $question->title ?? '') }}"
        @class([
            'block w-full rounded-xl border bg-white text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500',
            'border-gray-300' => !$errors->has('title'),
            'border-red-500'  =>  $errors->has('title'),
        ])
        aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}"
    />

    @error('title')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Contenido --}}
<div class="mt-4">
    <label for="content" class="mb-1 block text-sm font-medium text-gray-700">
        Contenido
    </label>

    <textarea
        id="content"
        name="content"
        rows="8"
        required
        placeholder="Describe tu problema, qué intentaste, errores y fragmentos de código relevantes."
        @class([
            'block w-full resize-y rounded-xl border bg-white text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500',
            'border-gray-300' => !$errors->has('content'),
            'border-red-500'  =>  $errors->has('content'),
        ])
        aria-invalid="{{ $errors->has('content') ? 'true' : 'false' }}"
    >{{ old('content', $question->content ?? '') }}</textarea>

    @error('content')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

{{-- Botones --}}
<div class="mt-6 flex items-center justify-end gap-3">
    <a
        href="{{ route('home') }}"
        class="rounded-xl border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
    >
        Cancelar
    </a>

    <button
        class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
    >
        Publicar pregunta
    </button>
</div>
