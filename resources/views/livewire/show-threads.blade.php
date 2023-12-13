<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-10 py-12">
    <div class="w-64">
        {{-- Botón de pregunta --}}
        <a href="{{ route('threads.create') }}"
            class="block w-full py-4 mb-10 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-bold text-sm text-center rounded-md">
            Preguntar
        </a>

        {{-- Listado de categoráis --}}
        <ul>
            @foreach ($categories as $category)
                <li class="mb-2">
                    {{-- Botón para el filtrado por categoría --}}
                    <a href="#" wire:click.prevent='filterByCategory({{ $category->id }})'
                        class="p-2 rounded-md flex bg-slate-800 items-center gap-2 text-white/60 hover:text-white font-semibold text-xs capitalize transition ease-in-out duration-150">
                        <span class="w-2 h-2 rounded-full" style="background-color: {{ $category->color }}"></span>
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
            {{-- Botón para reiniciar los valores de filtrado --}}
            <li class="mb-2">
                <a href="" wire:click.prevent='searchAll()'
                    class="p-2 rounded-md flex bg-slate-800 items-center gap-2 text-white/60 hover:text-white font-semibold text-xs transition ease-in-out duration-150">
                    <span class="w-2 h-2 rounded-full bg-[#000]"></span>
                    Todos los resultados
                </a>
            </li>
        </ul>
    </div>

    <div class="w-full">

        {{-- Campo para filtrar por título de pregunta --}}
        <form class="mb-4">
            <input type="text" class="bg-slate-800 border-0 rounded-md w-1/3 p-3 text-white/60 text-xs" placeholder="//..." wire:model.live='search'>
        </form>

        {{-- Imprime las preguntas --}}
        @foreach ($threads as $thread)
        <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
            <div class="p-4 flex gap-4">
                {{-- Avatar del usuario --}}
                <div>
                    <img class="rounded-md" src="{{ $thread->user->avatar() }}" alt="{{ $thread->user->name }}">
                </div>
                <div class="w-full">
                    {{-- Cuerpo de la pregunta --}}
                    <h2 class="mb-4 flex items-start justify-between">
                        {{-- Título de la pregunta y enlace a la pregunta individual el cual manda en sí la estructura de la pregunta --}}
                        <a href="{{ route('thread', $thread) }}" class="text-xl font-semibold text-white/90">
                            {{ $thread->title }}
                        </a>
                        {{-- Categoría de la pregunta --}}
                        <span class="rounded-full text-xs py-2 px-4 capitalize" style="color: {{ $thread->category->color }}; border: 1px solid {{ $thread->category->color }};">
                            {{ $thread->category->name }}
                        </span>
                    </h2>
                    <p class="flex items-center justify-between w-full text-xs">
                        {{-- Usuario que hizo la pregunta --}}
                        <span class="text-blue-600 font-semibold">
                            {{ $thread->user->name }}

                            {{-- Imprime el tiempo que ha transcurrido desde que se hizo la pregunta --}}
                            <span class="text-white/90">{{ $thread->created_at->diffForHumans() }}</span>
                        </span>
                        <span class="flex items-center gap-1 text-slate-500">
                            {{-- Ícono de chat --}}
                            <svg fill="currentColor" class="h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M5.337 21.718a6.707 6.707 0 01-.533-.074.75.75 0 01-.44-1.223 3.73 3.73 0 00.814-1.686c.023-.115-.022-.317-.254-.543C3.274 16.587 2.25 14.41 2.25 12c0-5.03 4.428-9 9.75-9s9.75 3.97 9.75 9c0 5.03-4.428 9-9.75 9-.833 0-1.643-.097-2.417-.279a6.721 6.721 0 01-4.246.997z"></path>
                            </svg>
                            {{-- Imprime la cantidad de respuestas que tiene --}}
                            {{ $thread->replies_count }}
                            {{-- Operador terneario para saber si tiene más de una respuesta para imprimir la 's' --}}
                            Respuesta{{ $thread->replies_count != 1 ? 's': ''}}

                            {{-- Hacemos válida la política de las preguntas. Si eres dueño de la pregunta, puedes editarla --}}
                            @can('update', $thread)
                                {{-- Imprime un botón para editar la pregunta --}}
                                | <a href="{{ route('threads.edit', $thread) }}" class="hover:text-white">Editar</a>
                            @endcan
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        {{-- Imprime los enlaces para la pagunación --}}
        <div class="text-white/60">
            {{ $threads->links() }}
        </div>
    </div>
</div>
