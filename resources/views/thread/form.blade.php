<div>
    <select name="category_id"
    class="bg-slate-700 hover:bg-slate-800 focus:bg-slate-800 border-1 border-slate-800 rounded-md w-full p-3 text-white/60 text-xs capitalize mb-4">
        {{-- Imprime una opción por defecto --}}
        <option value="">Seleccionar Categoría</option>

        {{-- Por cada categoría dada, se va a imprimir una opción --}}
        @foreach ($categories as $category)
            {{-- El valor es el id de la categoría --}}
            <option
            value="{{ $category->id }}"
            {{--
                Si el id de categoría de la pregunta es igual a la id de la categoría old() recuerda lo que tenía escrito/puesto 
                antes de refrescar
            --}}
            @if (old('category_id', $thread->category_id) == $category->id)
                {{-- Lo selecciona --}}
                selected
            @endif
            >
                {{-- Nombre de la categoría --}}
                {{ $category->name }}
            </option>
        @endforeach

    </select>

    {{-- Input que para el título de la pregunta, old() recuerda lo que tenía escrito/puesto antes de refrescar --}}
    <input
        type="text"
        name="title"
        placeholder="Título"
        class="bg-slate-700 hover:bg-slate-800 focus:bg-slate-800 border-1 border-slate-800 rounded-md w-full p-3 text-white/60 text-xs mb-4 font-semibold"
        value="{{ old('title', $thread->title) }}"
    >

    {{-- Cuerpo de la pregunta, old() recuerda lo que tenía escrito/puesto antes de refrescar --}}
    <textarea
        name="body"
        rows="10"
        placeholder="Descripción del problema"
        class="bg-slate-700 hover:bg-slate-800 focus:bg-slate-800 border-1 border-slate-800 rounded-md w-full p-3 text-white/60 text-xs capitalize mb-4"
    >{{ old('body', $thread->body) }}</textarea>

</div>