<?php

namespace App;

use App\Ruta;
use App\LineaChofer;
use App\TipoTransporte;
use App\PropietarioLinea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Linea extends Model
{
	use SoftDeletes;
    protected $table='lineas';

    protected $fillable = ['no_linea','ruta_id','tipo_transporte_id'];

    public function ruta()
    {
    	return $this->belongsTo(Ruta::class);
    }

    public function tipo_transporte()
    {
    	return $this->belongsTo(TipoTransporte::class);
    }

    public function propietarios()
    {
    	return $this->hasMany(PropietarioLinea::class);
    }

    public function propietario_actual()
    {
        return $this->hasOne(PropietarioLinea::class)->where('actual', true);
    }

    public function transportes()
    {
    	return $this->hasMany(Transporte::class);
    }

    public function pilotos()
    {
        return $this->hasMany(LineaChofer::class);
    }
}
