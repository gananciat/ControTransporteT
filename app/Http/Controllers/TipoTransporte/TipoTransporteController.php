<?php

namespace App\Http\Controllers\TipoTransporte;

use App\TipoTransporte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TipoTransporteController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.transportes.tipoTransporte');
    }

    public function index()
    {
        $tipoTransportes = TipoTransporte::all();
        return $this->showAll($tipoTransportes);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $tipoTransporte = TipoTransporte::create($data);

        return $this->showOne($tipoTransporte,201);
    }

    public function show(TipoTransporte $tipoTransporte)
    {
        return $this->showOne($tipoTransport); 
    }

    public function update(Request $request, tipoTransporte $tipoTransporte)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $tipoTransporte->nombre = $request->nombre;

         if (!$tipoTransporte->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $tipoTransporte->save();
        return $this->showOne($tipoTransporte);
    }

    public function destroy(TipoTransporte $tipoTransporte)
    {
        $tipoTransporte->delete();

        return $this->showOne($tipoTransporte);
    }
}
