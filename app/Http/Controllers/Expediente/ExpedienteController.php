<?php

namespace App\Http\Controllers\Expediente;

use App\Anio;
use App\Persona;
use App\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ExpedienteController extends ApiController
{
    public function __construct()
    {
        parent::__construct(); //proteje las rutas
    }

    //lista todos los registros de la tabla
    public function index()
    {
        $expedientes = Expediente::all();
        return $this->showAll($expedientes);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'propietario_id' => 'required|integer',
            'anio_id' => 'required|integer',
            "expediente" => "required|mimes:pdf|max:10000"
        ];

        
        $this->validate($request, $reglas);
        $propietario = Persona::find($request->propietario_id);
        $anio = Anio::find($request->anio_id);

        $folder = 'expediente_'.$anio->anio.'_'.$propietario->cui;

        $data = $request->all();
        $data['expediente'] = $request->expediente->store($folder);

        $expediente = Expediente::create($data);

        return $this->showOne($expediente,201);
    }

    //muestra un registro por id
    public function show(Expediente $expediente)
    {
        return $this->showOne($expediente);
    }

    //actualiza el registro
    public function update(Request $request, Expediente $expediente)
    {
        $reglas = [

        ];

        return $this->showOne($expediente);
    }

    //elminar registro de la tabla
    public function destroy(Expediente $expediente)
    {
        $expediente->delete();

        return $this->showOne($expediente);
    }
}
