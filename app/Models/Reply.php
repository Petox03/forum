<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable =[
        'reply_id',
        'thread_id',
        'body'
    ];

    //Una respuesta pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
    //Una respuesta pertenece a una pregunta
    public function thread(){
        return $this->belongsTo(Thread::class);
    }
    //Una respuesta tiene muchas respuestas
    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
