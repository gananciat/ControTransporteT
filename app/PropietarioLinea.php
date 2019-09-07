<?php

namespace App;

use App\Linea;
use App\Persona;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropietarioLinea extends Model
{
    use SoftDeletes;

    protected $table='propietario_lineas';

    protected $fillable = ['propietario_id','linea_id','actual'];

    public function linea()
    {
    	return $this->belongsTo(Linea::class);
    }

    public function propietario()
    {
    	return $this->belongsTo(Persona::class, 'propietario_id');
    }
}
