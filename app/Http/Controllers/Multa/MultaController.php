<?php

namespace App\Http\Controllers\Multa;

use App\Multa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class MultaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }

    public function view()
    {
       return view('layout.multas.multa');
       $this->middleware('admin')->except(['index','viewPagos']);
    }

    public function viewPagos()
    {
       return view('layout.multas.pagoMulta');
    }

    public function index()
    {
        $multas = Multa::with('causa.monto','transporte','inspeccion_multa.inspeccion','tipo_multa','agente','linea_chofer.chofer','linea_chofer.linea')->withTrashed()->get();
        return $this->showAll($multas);
    }

    public function store(Request $request)
    {
        $reglas = [
            'no_multa' => 'required|integer',
            'causa_id' => 'required',
            'tipo_multa_id'=> 'required',
            'linea_chofer_id'=> 'required',
            'transporte_id'=> 'required',
            'agente_id'=> 'required',
            'fecha_multa'=> 'required',
            'total_a_pagar' => 'required',
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();

        $multa = Multa::where('no_multa',$request->no_multa)->where('tipo_multa_id', $request->tipo_multa_id)->first();

        if($multa != null) return $this->errorResponse("numero de multa ya existe",422);

        $multa = Multa::create($data);

        return $this->showOne($multa,201);
    }

    public function show(Multa $multa)
    {
        return $this->showOne($multa);
    }

    public function update(Request $request, Multa $multa)
    {
        $reglas = [
            'fecha_pago' => 'required',
            'total_pagado' => 'required',
        ];

        $multa->fecha_pago = $request->fecha_pago;
        $multa->descuento = $request->descuento;
        $multa->fuera_de_tiempo = $request->fuera_de_tiempo;
        $multa->pagado = true;
        $multa->observacion = $request->observacion;
        $multa->total_pagado = $request->total_pagado;

         if (!$multa->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $multa->save();
        return $this->showOne($multa);
    }

    public function revertir($id)
    {
        $multa = Multa::find($id);

        $multa->fecha_pago = null;
        $multa->descuento = 0;
        $multa->fuera_de_tiempo = false;
        $multa->pagado = false;
        $multa->total_pagado = 0;

        $multa->save();
        return $this->showOne($multa);
    }

    public function destroy(Multa $multa)
    {
        $multa->delete();

        return $this->showOne($multa);
    }
}
