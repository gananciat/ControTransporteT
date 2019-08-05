<?php

namespace App\Http\Controllers\Anio;

use App\ConceptoPagoAnio;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ConceptoPagoAnioController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $concepto_pagos_anios = ConceptoPagoAnio::all();
        return $this->showAll($concepto_pagos_anios);
    }

    public function store(Request $request)
    {
        $reglas = [
            'anio_id' => 'required|exists:anios,id',
            'concepto_pago_id' => 'required|exists:concepto_pagos_anios,id',
            'cuota' => 'required|decimal'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $concepto_pago_anio = ConceptoPagoAnio::create($data);

        return $this->showOne($concepto_pagos_anio,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, ConceptoPagoAnio $conceptoPagoAnio)
    {
        $reglas = [
            'anio_id' => 'required|exists:anios,id',
            'concepto_pago_id' => 'required|exists:concepto_pagos_anios,id',
            'cuota' => 'required|decimal'
        ];

        $this->validate($request, $reglas);

        $conceptoPagoAnio->anio_id = $request->anio_id;
        $conceptoPagoAnio->concepto_pago_id = $request->concepto_pago_id;
        $conceptoPagoAnio->cuota = $request->cuota;

         if (!$conceptoPagoAnio->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $conceptoPagoAnio->save();
        return $this->showOne($conceptoPagoAnio);
    }

    public function destroy(ConceptoPago $conceptoPago)
    {
        $conceptoPago->delete();

        return $this->showOne($conceptoPago);
    }
}
