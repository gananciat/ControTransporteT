<?php

namespace App;

use App\Causa;
use App\Persona;
use App\TipoMulta;
use App\Transporte;
use App\LineaChofer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Multa extends Model
{
    use SoftDeletes;
    
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
    	'fuera_de_tiempo'
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
}
