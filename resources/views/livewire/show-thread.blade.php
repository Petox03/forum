<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 gap-10 py-12">
    <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
        <div class="p-4 flex gap-4">
            <div>
                <img class="rounded-md" src="{{ $thread->user->avatar() }}" alt="{{ $thread->user->name }}">
            </div>
            <div class="w-full">
                <h2 class="mb-4 flex items-start justify-between">
                    <a href="{{ route('thread', $thread) }}" class="text-xl font-semibold text-white/90">
                        {{ $thread->title }}
                    </a>
                    <span class="rounded-full text-xs py-2 px-4 capitalize"
                        style="color: {{ $thread->category->color }}; border: 1px solid {{ $thread->category->color }};">
                        {{ $thread->category->name }}
                    </span>
                </h2>
                <p class="mb-4 text-blue-600 font-semibold text-xs">
                    {{ $thread->user->name }}

                    <span class="text-white/90">{{ $thread->created_at->diffForHumans() }}</span>
                </p>
                <p class="text-white/70">
                    {{ $thread->body }}
                </p>
            </div>
        </div>
    </div>

    {{-- respuestas --}}
    @foreach ($replies as $reply)
        @livewire('show-reply', ['reply' => $reply], key('reply-'.$reply->id))
    @endforeach

    {{-- formulario --}}
    <form wire:submit.prevent='postReply' class="flex flex-row gap-1">
        <input type="text"
        class="bg-slate-800 border-0 rounded-md w-full p-3 text-white/60 text-xs"
        placeholder="Escribe una respuesta"
        wire:model='body'>
        <button
        type="submit"
        class="block w-1/2 md:w-1/4 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-semibold text-sm text-center rounded-md">
            Enviar Respuesta
        </button>
    </form>
</div>
