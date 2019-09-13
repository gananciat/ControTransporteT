<?php

namespace App;

use App\Linea;
use App\LineaTransporte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineaChofer extends Model
{
    use SoftDeletes;

    protected $table='linea_chofer';

    protected $fillable = ['linea_id','chofer_id','tipo_chofer','actual'];

    public function linea()
    {
    	return $this->belongsTo(Linea::class,'linea_id');
    }

    public function chofer()
    {
    	return $this->belongsTo(Persona::class, 'chofer_id');
    }
}
