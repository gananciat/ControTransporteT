<?php

namespace App;

use App\Persona;
use App\Transporte;
use App\InspeccionMulta;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspeccion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'inspecciones';
    protected $fillable= [
            'numero',
            'transporte_id',
            'agente_id',
            'fecha',
            'total_llantas',
            'platos',
			'retrovisores',
			'antena',
			'silvines',
			'stops',
			'tricket',
			'herramienta',
			'placas',
			'radio',
			'bocinas_radio',
			'vidrios',
			'tapon_conbustible',
			'tapon_radiadior',
			'plumillas',
			'alfombras',
			'pidevias',
			'reproductor',
			'otros_accesorios',
			'daños',
			'observacion',
    ];

    public function transporte()
    {
    	return $this->belongsTo(Transporte::class,'transporte_id');
    }

    public function agente()
    {
    	return $this->belongsTo(Persona::class,'agente_id');
    }

    public function inspeccion_multas()
    {
    	return $this->hasMany(InspeccionMulta::class,'inspeccion_id');
    }
}
