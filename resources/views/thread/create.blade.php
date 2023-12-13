<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 gap-10 py-12">
        <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900">
            <div class="p-4">
                <h2 class="mb-4 text-xl font-semibold text-white/90">
                    Preguntar a la comunidad
                </h2>

                <form action="{{ route('threads.store') }}" method="POST">
                    @csrf

                    @include('thread.form')

                    <button
                        type="submit"
                        class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-semibold rounded-md">
                        Crear Pregunta
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
