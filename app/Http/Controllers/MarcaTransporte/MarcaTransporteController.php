<?php

namespace App\Http\Controllers\MarcaTransporte;

use App\MarcaTransporte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class MarcaTransporteController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }

    public function view()
    {
       return view('layout.transportes.marcaTransporte');
    }

    public function index()
    {
        $marcaTransportes = MarcaTransporte::all();
        return $this->showAll($marcaTransportes);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $marcaTransporte = MarcaTransporte::create($data);

        return $this->showOne($marcaTransporte,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, MarcaTransporte $marcaTransporte)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $marcaTransporte->nombre = $request->nombre;

         if (!$marcaTransporte->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $marcaTransporte->save();
        return $this->showOne($marcaTransporte);
    }

    public function destroy(MarcaTransporte $marcaTransporte)
    {
        $marcaTransporte->delete();

        return $this->showOne($marcaTransporte);
    }
}
