<x-forum.layouts.home>
    <div class="mx-auto w-full max-w-3xl">
        <div class="mb-6">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Nueva pregunta</h2>
            <p class="mt-1 text-sm text-gray-500">Comparte tu duda con la comunidad. Sé claro y directo en el título.</p>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white/70 shadow-sm backdrop-blur">
            <div class="p-6">
                <form method="POST" action="{{ route('questions.store') }}" class="space-y-6">
                    @csrf
                    @include('questions._form', ['question' => new \App\Models\Question()])
                </form>
            </div>
        </div>
    </div>
</x-forum.layouts.home>
