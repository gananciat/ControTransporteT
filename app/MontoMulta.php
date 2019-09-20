<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Causa;

class MontoMulta extends Model
{
    use SoftDeletes;
    
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
