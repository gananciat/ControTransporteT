<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConceptoPago extends Model
{
    use SoftDeletes;
    
    protected $table = 'concepto_pagos';
    protected $fillable= [
    	'nombre',
    	'forma_pago'
    ];
}
