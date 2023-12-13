<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    //Validaciones de usuario
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Retorna el avatar del usuario dependiendo de si su email está registrado
    public function avatar(){
        return 'https://gravatar.com/avatar/' . md5($this->email) . '?s=50';
    }

    //Un usuario tiene muchas preguntas
    public function threads(){
        return $this->hasMany(Thread::class);
    }

    //Un usuario tiene muchas respuestas
    public function replies(){
        return $this->hasMany(Reply::class);
    }
}
