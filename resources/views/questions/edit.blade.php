<x-forum.layouts.home>
    <div class="mx-auto w-full max-w-3xl">
        <h2 class="text-2xl font-bold mb-6">Editar pregunta</h2>

        <div class="rounded-2xl border border-gray-200 bg-white/70 shadow-sm backdrop-blur">
            <div class="p-6">
                <form method="POST" action="{{ route('questions.update', $question) }}" class="space-y-6">
                    @csrf
                    @method('PUT')   {{-- MUY IMPORTANTE --}}
                    @include('questions._form', ['question' => $question])
                </form>
            </div>
        </div>
    </div>
</x-forum.layouts.home>
