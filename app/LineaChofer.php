<?php

namespace App;

use App\Linea;
use App\LineaTransporte;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineaChofer extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

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
