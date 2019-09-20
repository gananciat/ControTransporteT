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
    }

    public function view()
    {
       return view('layout.multas.multa');
    }

    public function index()
    {
        $multas = Multa::with('causa','transporte','tipo_multa','agente','linea_chofer.chofer')->get();
        return $this->showAll($multas);
    }

    public function store(Request $request)
    {
        $reglas = [
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
            'causa_id' => 'required',
            'tipo_multa_id'=> 'required',
            'linea_chofer_id'=> 'required',
            'transporte_id'=> 'required',
            'agente_id'=> 'required',
            'fecha_multa'=> 'required',
            'total_a_pagar' => 'required',
        ];

        $this->validate($request, $reglas);

        $multa->causa_id = $request->causa_id;
        $multa->tipo_multa_id = $request->tipo_multa_id;
        $multa->linea_chofer_id = $request->linea_chofer_id;
        $multa->transporte_id = $request->transporte_id;
        $multa->agente_id = $request->agente_id;
        $multa->fecha_multa = $request->fecha_multa;
        $multa->total_a_pagar = $request->total_a_pagar;
        $multa->fecha_multa = $request->fecha_multa;
        $multa->observacion = $request->observacion;

         if (!$multa->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $multa->save();
        return $this->showOne($multa);
    }

    public function destroy(Multa $multa)
    {
        $multa->delete();

        return $this->showOne($multa);
    }
}
