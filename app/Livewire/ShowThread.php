<?php

namespace App\Livewire;

use App\Models\Thread;
use Livewire\Component;
use Livewire\WithPagination;

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
        return view('livewire.show-thread', [
            'replies' => $this->thread
                ->replies()
                ->whereNull('reply_id')
                ->with('user', 'replies.user', 'replies.replies')
                ->get()
        ]);
    }
}
