<?php

namespace App\Http\Controllers\Linea;

use App\Linea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class LineaPropietarioLineaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Linea $linea)
    {
        $propietarios = $linea->propietarios()->with('propietario')->orderBy('id','desc')->get();
        return $this->showAll($propietarios);
    }

}
