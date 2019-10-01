<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class UbicacionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }

    public function view()
    {
       return view('layout.administracion.ubicacion');
    }

    public function index()
    {
        $ubicaciones = Ubicacion::all();
        return $this->showAll($ubicaciones);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $ubicacion = Ubicacion::create($data);

        return $this->showOne($ubicacion,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Ubicacion $ubicacion)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $ubicacion->nombre = $request->nombre;

         if (!$ubicacion->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $ubicacion->save();
        return $this->showOne($ubicacion);
    }

    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->delete();

        return $this->showOne($ubicacion);
    }
}
