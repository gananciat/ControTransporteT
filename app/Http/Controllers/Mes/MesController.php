<?php

namespace App\Http\Controllers\Mes;

use App\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class MesController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }

    public function view()
    {
       return view('layout.administracion.mes');
    }

    public function index()
    {
        $meses = TipoPersona::all();
        return $this->showAll($meses);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $mes = TipoPersona::create($data);

        return $this->showOne($mes,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Mes $mes)
    {
        $reglas = [
            'mes' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $mes->nombre = $request->mes;

         if (!$mes->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $mes->save();
        return $this->showOne($mes);
    }

    public function destroy(Mes $mes)
    {
        $mes->delete();

        return $this->showOne($mes);
    }
}
