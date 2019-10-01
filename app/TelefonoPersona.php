<?php

namespace App;

use App\Persona;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TelefonoPersona extends Model implements Auditable
{
    //use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'telefono_personas';
    protected $fillable= [
    	'persona_id',
    	'telefono'
    ];

    public function persona()
    {
    	return $this->belongsTo(Persona::class);
    }
}
