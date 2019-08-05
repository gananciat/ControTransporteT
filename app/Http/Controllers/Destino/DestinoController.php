<?php

namespace App\Http\Controllers\Destino;

use App\Destino;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class DestinoController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.administracion.destino');
    }

    public function index()
    {
        $destinos = Destino::all();
        return $this->showAll($destinos);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $destino = Destino::create($data);

        return $this->showOne($destino,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Destino $destino)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $destino->nombre = $request->nombre;

         if (!$destino->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $destino->save();
        return $this->showOne($destino);
    }

    public function destroy(Destino $destino)
    {
        $destino->delete();

        return $this->showOne($destino);
    }
}
