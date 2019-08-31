<?php

namespace App;

use App\Persona;
use Illuminate\Database\Eloquent\Model;

class TelefonoPersona extends Model
{
    //use SoftDeletes;

    protected $table = 'telefono_personas';
    protected $fillable= [
    	'persona_id',
    	'telefono'
    ];

    public function persona()
    {
    	return $this->belongsTo(Persona::class);
    }
}
