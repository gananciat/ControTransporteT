<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model Implements Auditable
{
	use SoftDeletes;
	use \OwenIt\Auditing\Auditable;

    protected $table = 'ubicaciones';
    protected $fillable= [
    	'nombre'
    ];
}
