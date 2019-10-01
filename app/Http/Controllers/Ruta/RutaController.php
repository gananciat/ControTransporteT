<?php

namespace App\Http\Controllers\Ruta;

use App\Ruta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class RutaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin')->except(['index','view']);
    }

    public function view()
    {
       return view('layout.transportes.ruta');
    }

    public function index()
    {
        $rutas = Ruta::with('ubicacion','destino')->get();
        return $this->showAll($rutas);
    }

    public function store(Request $request)
    {
        $reglas = [
            'ubicacion_id' => 'required|integer',
            'destino_id' => 'required|integer'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $ruta = Ruta::create($data);

        return $this->showOne($ruta,201);
    }

    public function show(Ruta $ruta)
    {
        return $this->showOne($ruta);
    }

    public function update(Request $request, ruta $ruta)
    {
        $reglas = [
            'ubicacion_id' => 'required|integer',
            'destino_id' => 'required|integer'
        ];

        $this->validate($request, $reglas);

        $ruta->ubicacion_id = $request->ubicacion_id;
        $ruta->destino_id = $request->destino_id;

         if (!$ruta->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $ruta->save();
        return $this->showOne($ruta);
    }

    public function destroy(Ruta $ruta)
    {
        $ruta->delete();

        return $this->showOne($ruta);
    }
}
