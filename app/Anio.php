<?php

namespace App;

use App\ConceptoPagoAnio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anio extends Model
{
    use SoftDeletes;

    protected $table = 'anios';
    protected $fillable= [
    	'anio'
    ];

    public function concepto_pago_anios()
    {
    	return $this->hasMany(ConceptoPagoAnio::class);
    }
}
