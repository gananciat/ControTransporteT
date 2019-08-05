<?php

namespace App;

use App\Anio;
use App\ConceptoPago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConceptoPagoAnio extends Model
{
    use SoftDeletes;

    protected $table = 'concepto_pago_anios';
    protected $fillable= [
    	'anio_id',
    	'concepto_pago_id',
    	'cuota'
    ];

    public function anio()
    {
    	return $this->belongsTo(Anio::class);
    }

    public function concepto_pago()
    {
    	return $this->belongsTo(ConceptoPago::class);
    }
}
