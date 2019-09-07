<?php

namespace App;

use App\Expediente;
use App\TipoPersona;
use App\TelefonoPersona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $table = 'personas';
    protected $fillable= [
    	'cui',
    	'nombre_uno',
    	'nombre_dos',
    	'apellido_uno',
    	'apellido_dos',
    	'email',
    	'fecha_nac',
    	'tipo_persona_id',
        'foto',
        'direccion'
    ];

    public function telefonos()
    {
        return $this->hasMany(TelefonoPersona::class);
    }

    public function expedientes()
    {
        return $this->hasMany(Expediente::class,'propietario_id');
    }

    public function tipo_persona()
    {
        return $this->belongsTo(TipoPersona::class);
    }
}
