<?php

namespace App;

use App\Linea;
use App\ConceptoPagoAnio;
use App\PropietarioLinea;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table='pagos';

    protected $fillable = ['propietario_linea_id','concepto_pago_anio_id','total','anulado'];

    public function propietario_linea()
    {
    	return $this->belongsTo(PropietarioLinea::class,'propietario_linea_id');
    }

    public function concepto_pago_anio()
    {
    	return $this->belongsTo(ConceptoPagoAnio::class,'concepto_pago_anio_id');
    }
}
