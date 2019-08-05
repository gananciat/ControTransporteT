<?php

namespace App\Http\Controllers\Cargo;

use App\Cargo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CargoController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.administracion.cargo');
    }

    public function index()
    {
        $cargos = Cargo::all();
        return $this->showAll($cargos);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $cargo = Cargo::create($data);

        return $this->showOne($cargo,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Cargo $cargo)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $cargo->nombre = $request->nombre;

         if (!$cargo->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $cargo->save();
        return $this->showOne($cargo);
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();

        return $this->showOne($cargo);
    }
}
