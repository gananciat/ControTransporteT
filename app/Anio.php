<?php

namespace App;

use App\ConceptoPagoAnio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Anio extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'anios';
    protected $fillable= [
    	'anio'
    ];

    public function concepto_pago_anios()
    {
    	return $this->hasMany(ConceptoPagoAnio::class);
    }
}
