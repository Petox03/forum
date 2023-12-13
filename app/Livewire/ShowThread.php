<?php

namespace App\Livewire;

use App\Models\Thread;
use Livewire\Component;
use Livewire\WithPagination;

class ShowThread extends Component
{
    /* Variables para mostrar una pregunta individual */
    public Thread $thread;
    public $body;

    /* Crea una respuesta para la pregunta */
    public function postReply(){
        /* Validar datos */
        $this->validate(['body' => 'required']);

        /* crear respuesta */
        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body
        ]);

        /* Reiniciar */
        $this->body = '';
    }

    public function render()
    {
        /* Retorna la vista */
        return view('livewire.show-thread', [
            /* Manda las respuestas de la pregunta seleccionada */
            'replies' => $this->thread
                ->replies()
                /* Filtra las respuestas hijas de las respuestas de la pregunta */
                ->whereNull('reply_id')
                /* Se cargan las relaciones user y category para cada respuesta */
                ->with('user', 'replies.user', 'replies.replies')
                ->get()
        ]);
    }
}
