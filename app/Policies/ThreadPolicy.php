<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    //Va a corroborar que solo los usuarios puedan actualizar sus propias preguntas
    public function update(User $user, Thread $thread){
        //retorna si el id del usuario es correspondiente al id de usuario que tiene la pregunta
        return $user->id === $thread->user_id;
    }
}
