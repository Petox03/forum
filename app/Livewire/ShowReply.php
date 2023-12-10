<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;

class ShowReply extends Component
{
    public Reply $reply;
    public $body = '';
    public $is_creating = false;

    /* Este evento no es necesario sólo que está en el curso */
    //protected $listener = ['refresh' => '$refresh'];

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

    public function render()
    {
        return view('livewire.show-reply');
    }
}
