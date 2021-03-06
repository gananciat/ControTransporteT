<?php

namespace App;

use App\Expediente;
use App\TipoPersona;
use App\TelefonoPersona;
use App\PropietarioLinea;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

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
        'direccion',
        'licencia'
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

    public function propietario_linea()
    {
        return $this->hasMany(PropietarioLinea::class, 'propietario_id');
    }

    public function propietario_linea_actual()
    {
        return $this->hasMany(PropietarioLinea::class, 'propietario_id')->where('actual',true);
    }
}
