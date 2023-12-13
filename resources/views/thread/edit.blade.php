<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 gap-10 py-12">
        <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900">
            <div class="p-4">
                <h2 class="mb-4 text-xl font-semibold text-white/90">
                    Editar Pregunta
                </h2>

                {{-- Form que manda a la ruta update de las preguntas --}}
                <form action="{{ route('threads.update', $thread) }}" method="POST">
                    {{-- medida de seguridad para protegerse contra ataques de falsificación de solicitudes entre sitios --}}
                    @csrf
                    {{-- Indicamos que es una solicitud PUT --}}
                    @method('PUT')

                    {{-- Componente de formulario --}}
                    @include('thread.form')

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-semibold rounded-md">
                        Editar Pregunta
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
