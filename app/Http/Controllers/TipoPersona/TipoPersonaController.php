<?php

namespace App\Http\Controllers\TipoPersona;

use App\TipoPersona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TipoPersonaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.administracion.tipoPersona');
    }

    public function index()
    {
        $tipo_personas = TipoPersona::all();
        return $this->showAll($tipo_personas);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $tipo_persona = TipoPersona::create($data);

        return $this->showOne($tipo_persona,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, TipoPersona $tipoPersona)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $tipoPersona->nombre = $request->nombre;

         if (!$tipoPersona->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $tipoPersona->save();
        return $this->showOne($tipoPersona);
    }

    public function destroy(TipoPersona $tipoPersona)
    {
        $tipoPersona->delete();

        return $this->showOne($tipoPersona);
    }
}
