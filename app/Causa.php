<?php

namespace App;

use App\MontoMulta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Causa extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'causas';
    protected $fillable= [
    	'nombre',
    	'monto_multa_id'
    ];

    public function monto()
    {
    	return $this->belongsTo(MontoMulta::class,'monto_multa_id');
    }
}
