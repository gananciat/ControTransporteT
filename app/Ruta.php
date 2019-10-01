<?php

namespace App;

use App\Destino;
use App\Ubicacion;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model implements Auditable
{
	use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

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
