<?php

namespace App\Http\Controllers\Linea;

use App\Linea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class LineaLineaChoferController extends ApiController
{ 
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Linea $linea)
    {
        $choferes = $linea->pilotos()->with('chofer')->orderBy('id','desc')->get();
        return $this->showAll($choferes);
    }
}
