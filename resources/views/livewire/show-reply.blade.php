<div>
    <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
        <div class="p-4 flex gap-4">
            {{-- Imprime el avatar del user --}}
            <div>
                <img class="rounded-md" src="{{ $reply->user->avatar() }}" alt="{{ $reply->user->name }}">
            </div>
            <div class="w-full">
                <p class="mb-2 text-blue-600 font-semibold text-xs">
                    {{ $reply->user->name }}
                    <span class="float-right text-white/90">{{ $reply->created_at->diffForHumans() }}</span>
                </p>

                {{-- formulario / vista respuesta --}}

                {{-- Si está editando enseña el form de la edición --}}
                @if ($is_editing)
                    <form wire:submit.prevent='updateReply' class="flex flex-row gap-1 mt-4">
                        {{-- El input se relaciona a body para poder obtener qué tenía la respuesta --}}
                        <input type="text"
                            class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs"
                            placeholder="Escribe una respuesta" wire:model='body'>
                        <button type="submit"
                            class="block w-1/2 md:w-1/4 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-semibold text-sm text-center rounded-md">
                            Editar Respuesta
                        </button>
                    </form>
                {{-- Si no está editando entonces sólo enseña la respuesta --}}
                @else
                    <p class="text-white/70">
                        {{ $reply->body }}
                    </p>
                @endif

                {{-- formulario --}}

                {{-- Si está haciendo una respuesta enseña el form --}}
                @if ($is_creating)
                    <form wire:submit.prevent='postChild' class="flex flex-row gap-1 mt-4">
                        <input type="text"
                            class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs"
                            placeholder="Escribe una respuesta" wire:model='body'>
                        <button type="submit"
                            class="block w-1/2 md:w-1/4 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-semibold text-sm text-center rounded-md">
                            Responder
                        </button>
                    </form>
                @endif

                <p class="mt-4 text-white/70 flex gap-2 justify-end">
                    {{-- Si la respuesta no tiene un padre puedes seguir respondiendo --}}
                    @if (is_null($reply->reply_id))
                        <a href="" wire:click.prevent='$toggle("is_creating")'
                            class="hover:text-white">Responder</a>
                    @endif

                    {{-- Hacemos válida la política de las respuestas. Si eres dueño de la respuesta, puedes editarla --}}
                    @can('update', $reply)
                        <a href="" wire:click.prevent='$toggle("is_editing")' class="hover:text-white">Editar</a>
                    @endcan
                </p>
            </div>
        </div>
    </div>

    {{-- respuestas --}}
    @foreach ($reply->replies as $item)
        <div class="ml-12">
            @livewire('show-reply', ['reply' => $item], key('reply-' . $item->id))
        </div>
    @endforeach
</div>
