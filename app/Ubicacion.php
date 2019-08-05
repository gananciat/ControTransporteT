<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{
	use SoftDeletes;

    protected $table = 'ubicaciones';
    protected $fillable= [
    	'nombre'
    ];
}
