<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporte extends Model
{
    use SoftDeletes;

    protected $table='transportes';

    protected $fillable = [
    	'placa',
    	'modelo',
    	'marca_transporte_id',
    	'no_tarjeta',
    	'no_seguro',
    	'no_chasis',
    	'linea',
    	'no_motor',
    	'color'
    ];
}
