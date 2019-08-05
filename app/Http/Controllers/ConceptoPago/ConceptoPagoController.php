<?php

namespace App\Http\Controllers\ConceptoPago;

use App\ConceptoPago;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ConceptoPagoController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.configuracion.conceptoPago');
    }

    public function index()
    {
        $concepto_pagos = ConceptoPago::all();
        return $this->showAll($concepto_pagos);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string',
            'forma_pago' => 'required'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $concepto_pagos = ConceptoPago::create($data);

        return $this->showOne($concepto_pagos,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, ConceptoPago $conceptoPago)
    {
        $reglas = [
            'nombre' => 'required|string',
            'forma_pago' => 'required'
        ];

        $this->validate($request, $reglas);

        $conceptoPago->nombre = $request->nombre;
        $conceptoPago->forma_pago = $request->forma_pago;

         if (!$conceptoPago->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $conceptoPago->save();
        return $this->showOne($conceptoPago);
    }

    public function destroy(ConceptoPago $conceptoPago)
    {
        $conceptoPago->delete();

        return $this->showOne($conceptoPago);
    }
}
