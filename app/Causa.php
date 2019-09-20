<?php

namespace App;

use App\MontoMulta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Causa extends Model
{
    use SoftDeletes;
    
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
