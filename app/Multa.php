<?php

namespace App;

use App\Causa;
use App\Persona;
use App\TipoMulta;
use App\Transporte;
use App\LineaChofer;
use App\InspeccionMulta;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Multa extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'multas';

    protected $fillable= [
    	'causa_id',
    	'tipo_multa_id',
    	'linea_chofer_id',
    	'transporte_id',
    	'agente_id',
    	'fecha_multa',
    	'fecha_pago',
    	'pagado',
    	'total_pagado',
    	'total_a_pagar',
    	'descuento',
    	'observacion',
    	'fuera_de_tiempo',
        'no_multa'
    ];

    public function linea_chofer()
    {
    	return $this->belongsTo(LineaChofer::class);
    }

    public function causa()
    {
    	return $this->belongsTo(Causa::class);
    }

    public function transporte()
    {
    	return $this->belongsTo(Transporte::class);
    }

    public function tipo_multa()
    {
    	return $this->belongsTo(TipoMulta::class);
    }

    public function agente()
    {
    	return $this->belongsTo(Persona::class,'agente_id');
    }

    public function inspeccion_multa()
    {
        return $this->hasOne(InspeccionMulta::class,'multa_id');
    }
}
