<?php

namespace App;

use App\Persona;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email', 'password', 'persona_id','tipo_usuario_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function tipo_usuario(){
        return $this->belongsTo(TipoUsuario::class);
    }

}
