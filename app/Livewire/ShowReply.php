<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;

class ShowReply extends Component
{
    /* Variables de la respuesta */
    public Reply $reply;
    public $body = '';
    public $is_creating = false;
    public $is_editing = false;

    /* Este evento no es necesario sólo que está en el curso */
    //protected $listener = ['refresh' => '$refresh'];

    //Capta un cambio en una variable
    public function updatedIsEditing(){
        //Sólo el usuario que creó la respuesta puede editarla
        $this->authorize('update', $this->reply);
        //Si está editando cancela el crear respuesta y pone en el input el body de esa respuesta
        $this->is_creating = false;
        $this->body = $this->reply->body;
    }
    //Cancela el editar
    public function updatedIsCreating(){
        /* Si está creando entonces cancela la edición y reinciia el cuerpo */
        $this->is_editing = false;
        $this->body = "";
    }

    //Crea una respuesta hija
    public function postChild(){

        //Si el id de la respuesta no es nulo impide mandar otra respuesta hija
        if( !is_null($this->reply->reply_id)) return;

        /* Validar */
        $this->validate(['body' => 'required']);

        /* create */
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body
        ]);

        //Borra todo el cuerpo
        $this->body = '';
        $this->is_creating = false;

        /* Parece que no es necesario */
        //$this->dispatch('refresh')->self();
    }

    //Actualiza una respuesta
    public function updateReply(){

        //Sólo si yo hice la respuesta la puedo editar
        $this->authorize('update', $this->reply);

        /* Validar */
        $this->validate(['body' => 'required']);

        /* update */
        $this->reply->update([
            'body' => $this->body
        ]);

        /* Reinicia los valores de la respuesta y cancela la edición */
        $this->body = '';
        $this->is_editing = false;
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
