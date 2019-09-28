<?php

namespace App\Http\Controllers\Persona;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PropietarioPagoController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function index(Persona $persona)
    {
        $pagos = $persona->propietario_linea()->with('pagos.propietario_linea.linea.tipo_transporte','pagos.concepto_pago_anio.concepto_pago','pagos.concepto_pago_anio.anio')->get()->pluck('pagos')->collapse()->values();

        return $this->showAll($pagos);
    }
}
