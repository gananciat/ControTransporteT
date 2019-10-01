<?php

namespace App;

use App\Pago;
use App\Linea;
use App\Persona;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropietarioLinea extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table='propietario_lineas';

    protected $fillable = ['propietario_id','linea_id','actual'];

    public function linea()
    {
    	return $this->belongsTo(Linea::class);
    }

    public function propietario()
    {
    	return $this->belongsTo(Persona::class, 'propietario_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class,'propietario_linea_id');
    }
}
