<?php

namespace App;

use App\Destino;
use App\Ubicacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
	use SoftDeletes;

    protected $table = 'rutas';

    protected $fillable = ['ubicacion_id','destino_id'];

    public function ubicacion()
    {
    	return $this->belongsTo(Ubicacion::class);
    }

    public function destino()
    {
    	return $this->belongsTo(Destino::class);
    }

}
