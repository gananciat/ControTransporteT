<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspeccionMulta extends Model
{
    protected $table = 'inspeciones_multas';
    protected $fillable= [
            'inspeccion_id',
            'multa_id',
    ];

    public function inspeccion()
    {
    	return $this->belongsTo(Inspeccion::class,'inspeccion_id');
    }

    public function multa()
    {
    	return $this->belongsTo(Multa::class,'multa_id');
    }
}
