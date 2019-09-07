<?php

namespace App;

use App\LineaTransporte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChoferLineaTransporte extends Model
{
    use SoftDeletes;

    protected $table='chofer_linea_transportes';

    protected $fillable = ['linea_transporte_id','chofer_id','tipo_chofer','actual'];

    public function linea_transporte()
    {
    	return $this->belongsTo(LineaTransporte::class,'linea_transporte_id');
    }

    public function chofer()
    {
    	return $this->belongsTo(Persona::class, 'chofer_id');
    }
}
