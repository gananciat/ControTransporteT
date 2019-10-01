<?php

namespace App;

use App\Causa;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class MontoMulta extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'monto_multas';
    protected $fillable= [
    	'monto',
    	'porcentaje_descuento'
    ];

    public function causas()
    {
    	return $this->hasMany(Causa::class);
    }
}
