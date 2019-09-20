<?php

namespace App\Http\Controllers\TipoMulta;

use App\TipoMulta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TipoMultaController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.multas.tipoMulta');
    }

    public function index()
    {
        $tipoMultas = TipoMulta::all();
        return $this->showAll($tipoMultas);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string',
            'tiempo_expira' =>'required'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $tipoMulta = TipoMulta::create($data);

        return $this->showOne($tipoMulta,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, TipoMulta $tipoMulta)
    {
        $reglas = [
            'nombre' => 'required|string',
            'tiempo_expira' =>'required'
        ];

        $this->validate($request, $reglas);

        $tipoMulta->nombre = $request->nombre;

         if (!$tipoMulta->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $tipoMulta->save();
        return $this->showOne($tipoMulta);
    }

    public function destroy(TipoMulta $tipoMulta)
    {
        $tipoMulta->delete();

        return $this->showOne($tipoMulta);
    }
}
