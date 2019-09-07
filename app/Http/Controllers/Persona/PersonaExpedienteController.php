<?php

namespace App\Http\Controllers\Persona;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PersonaExpedienteController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Persona $persona)
    {
        $expedientes = $persona->expedientes()->with('anio')->get();
        return $this->showAll($expedientes);
    }
}
