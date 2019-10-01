<?php

namespace App;

use App\Linea;
use App\MarcaTransporte;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporte extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table='transportes';

    protected $fillable = [
    	'placa',
    	'modelo',
    	'marca_transporte_id',
    	'no_tarjeta',
    	'no_seguro',
    	'no_chasis',
    	'linea_transporte',
    	'no_motor',
    	'color',
        'linea_id',
        'actual'
    ];

    public function linea()
    {
        return $this->belongsTo(Linea::class);
    }

    public function marca_transporte()
    {
        return $this->belongsTo(MarcaTransporte::class);
    }
}
