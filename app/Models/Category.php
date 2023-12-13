<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Una categoría tiene a muchas preguntas
    public function threads(){
        return $this->hasMany(Thread::class);
    }
}
