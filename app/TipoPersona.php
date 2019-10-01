<?php

namespace App;

use App\Persona;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPersona extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_personas';
    protected $fillable= [
    	'nombre'
    ];

    public function personas()
    {
    	return $this->hasMany(Persona::class);
    }
}
