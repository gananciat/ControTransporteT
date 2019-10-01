<?php

namespace App;

use App\Anio;
use App\Persona;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expediente extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table="expedientes";

    protected $fillable = ['propietario_id','anio_id','expediente'];

    public function propietario()
    {
    	return $this->belongsTo(Persona::class,'propietario_id');
    }

    public function anio()
    {
    	return $this->belongsTo(Anio::class,'anio_id');
    }
}
