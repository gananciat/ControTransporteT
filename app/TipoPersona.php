<?php

namespace App;

use App\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPersona extends Model
{
    use SoftDeletes;

    protected $table = 'tipo_personas';
    protected $fillable= [
    	'nombre'
    ];

    public function personas()
    {
    	return $this->hasMany(Persona::class);
    }
}
