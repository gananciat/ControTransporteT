<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mes extends Model
{
    use SoftDeletes;
    
    protected $table = 'mes';
    protected $fillable= [
    	'mes'
    ];
}
