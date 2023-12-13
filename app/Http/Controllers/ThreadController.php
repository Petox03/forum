<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /* Renderiza la vista de las ediciones de las preguntas y le envía la pregunta*/
    public function edit(Thread $thread){
        try {
            /* Sólo el usuario que creó la pregunta puede acceder a la vista de esta edición */
            $this->authorize('update', $thread);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            //Si la pregunta no le corresponde lo redirige al dashboard
            return redirect()->route('dashboard');
        }

        //guarda las categorías existentes
        $categories = Category::get();

        //retorna la vista de la edición de las preguntas y manda las categirías y la pregunta
        return view('thread.edit', compact('categories', 'thread'));
    }

    //Actualiza la pregunta
    public function update(Request $request, Thread $thread){

        //Valida que el usuario sea dueño de la pregunta
        $this->authorize('update', $thread);

        //Valida que todos los campos estén llenos
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        //Si pasa la validación, actualiza la pregunta
        $thread->update($request->all());

        //Te regresa a la vista de la pregunta individual
        return redirect()->route('thread', $thread);
    }

    /* Renderiza la vista de la creación de una pregunta */
    public function create(Thread $thread){
        /* Obtiene todas las categorías */
        $categories = Category::get();

        /*
         * Retorna la vista de la creación de una pregunta y manda las categorías y la pregunta para el correcto funcionamiento
         * de la reutilización de la vista del formulario
         */
        return view('thread.create', compact('categories', 'thread'));
    }

    /* Guarda la pregunta */
    public function store(Request $request,){
        /* Valida que los campos de la pregunta estén llenos */
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        /* Crea una pregunta a base del id del usuario */
        auth()->user()->threads()->create($request->all());

        /* Redirige al dashboard */
        return redirect()->route('dashboard');
    }

}
