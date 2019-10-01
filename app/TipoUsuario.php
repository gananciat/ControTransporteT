<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUsuario extends Model implements Auditable
{
    //use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_usuarios';
    protected $fillable= [
    	'nombre'
    ];
}
