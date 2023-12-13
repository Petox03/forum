<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy
{
    //Va a corroborar que solo los usuarios puedan actualizar sus propias respuestas
    public function update(User $user, Reply $reply){
        //retorna si el id del usuario es correspondiente al id de usuario que tiene la respuesta
        return $user->id === $reply->user_id;
    }
}
