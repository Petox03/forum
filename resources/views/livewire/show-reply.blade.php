<div>
    <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
        <div class="p-4 flex gap-4">
            <div>
                <img class="rounded-md" src="{{ $reply->user->avatar() }}" alt="{{ $reply->user->name }}">
            </div>
            <div class="w-full">
                <p class="mb-2 text-blue-600 font-semibold text-xs">
                    {{ $reply->user->name }}
                    <span class="float-right text-white/90">{{ $reply->created_at->diffForHumans() }}</span>
                </p>
                <p class="text-white/70">
                    {{ $reply->body }}
                </p>
                <p class="mt-4 text-white/70 flex gap-2 justify-end">
                    <a href="" class="hover:text-white">Responder</a>
                    <a href="" class="hover:text-white">Editar</a>
                </p>
            </div>
        </div>
    </div>

    {{-- respuestas --}}
    @foreach ($reply->replies as $item)
        <div class="ml-12">
            @livewire('show-reply', ['reply' => $item], key('reply-'.$item->id))
        </div>
    @endforeach
</div>
