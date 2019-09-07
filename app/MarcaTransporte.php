<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarcaTransporte extends Model
{
    use SoftDeletes;

    protected $table = 'marca_transportes';
    protected $fillable= [
    	'nombre'
    ];
}
