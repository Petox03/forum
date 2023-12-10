<?php

namespace App\Livewire;

use App\Models\Thread;
use Livewire\Component;

class ShowThread extends Component
{
    public Thread $thread;
    public $body;

    public function postReply(){
        /* Validar */
        $this->validate(['body' => 'required']);

        /* create */
        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body
        ]);

        $this->body = '';
    }

    public function render()
    {
        return view('livewire.show-thread');
    }
}
