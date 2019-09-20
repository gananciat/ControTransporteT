<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMulta extends Model
{
    use SoftDeletes;
    
    protected $table = 'tipo_multas';
    protected $fillable= [
    	'nombre',
    	'tiempo_expira'
    ];
}
