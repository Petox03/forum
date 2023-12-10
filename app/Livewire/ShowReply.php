<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;

class ShowReply extends Component
{
    public Reply $reply;
    public $body = '';
    public $is_creating = false;
    public $is_editing = false;

    /* Este evento no es necesario sólo que está en el curso */
    //protected $listener = ['refresh' => '$refresh'];

    //Capta un cambio en una variable
    public function updatedIsEditing(){
        $this->is_creating = false;
        $this->body = $this->reply->body;
    }
    public function updatedIsCreating(){
        $this->is_editing = false;
        $this->body = "";
    }

    public function postChild(){

        if( !is_null($this->reply->reply_id)) return;

        /* Validar */
        $this->validate(['body' => 'required']);

        /* create */
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body
        ]);

        $this->body = '';
        $this->is_creating = false;

        /* Parece que no es necesario */
        //$this->dispatch('refresh')->self();
    }
    
    public function updateReply(){

        /* Validar */
        $this->validate(['body' => 'required']);

        /* update */
        $this->reply->update([
            'body' => $this->body
        ]);

        $this->body = '';
        $this->is_editing = false;
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
