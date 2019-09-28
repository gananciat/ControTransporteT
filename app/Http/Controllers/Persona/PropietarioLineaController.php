<?php

namespace App\Http\Controllers\Persona;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PropietarioLineaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Persona $persona)
    {
        $lineas = $persona->propietario_linea_actual()->with('linea')->get();
        return $this->showAll($lineas);
    }
}
