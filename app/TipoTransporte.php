<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoTransporte extends Model
{
    use SoftDeletes;
    
    protected $table = 'tipo_transportes';
    
    protected $fillable= [
    	'nombre'
    ];
}
