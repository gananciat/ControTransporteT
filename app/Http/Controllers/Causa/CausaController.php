<?php

namespace App\Http\Controllers\Causa;

use App\Causa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CausaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.multas.causa');
    }

    public function index()
    {
        $causas = Causa::with('monto')->get();
        return $this->showAll($causas);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string',
            'monto_multa_id' => 'required|integer'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $causa = Causa::create($data);

        return $this->showOne($causa,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Causa $causa)
    {
        $reglas = [
            'nombre' => 'required|string',
            'monto_multa_id' => 'required|integer'
        ];

        $this->validate($request, $reglas);

        $causa->nombre = $request->nombre;

         if (!$causa->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $causa->save();
        return $this->showOne($causa);
    }

    public function destroy(Causa $causa)
    {
        $causa->delete();

        return $this->showOne($causa);
    }
}
