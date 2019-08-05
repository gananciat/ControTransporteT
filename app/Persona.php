<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $table = 'personas';
    protected $fillable= [
    	'codigo',
    	'nombre_uno',
    	'nombre_dos',
    	'apellido_uno',
    	'apellido_dos',
    	'email',
    	'fecha_nac',
    	'tipo_persona_id'
    ];
}
