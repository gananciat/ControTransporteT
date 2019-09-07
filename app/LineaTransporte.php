<?php

namespace App;

use App\Linea;
use App\Transporte;
use App\ChoferLineaTransporte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineaTransporte extends Model
{
    use SoftDeletes;

    protected $table='linea_transportes';

    protected $fillable = ['transporte_id','linea_id','actual'];

    public function linea()
    {
    	return $this->belongsTo(Linea::class);
    }

    public function transporte()
    {
    	return $this->belongsTo(Transporte::class);
    }

    public function choferes()
    {
        return $this->hasMany(ChoferLineaTransporte::class);
    }
}
