<?php

namespace App\Http\Controllers\Linea;

use App\PropietarioLinea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PropietarioLineaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $propietarioLineas = propietarioLinea::all();
        return $this->showAll($propietarioLineas);
    }

    public function store(Request $request)
    {
        $reglas = [
            'linea_id' => 'required|integer',
            'propietario_id' => 'required|integer'
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();
        $data = $request->all();
        $propietario_lineas = PropietarioLinea::where('linea_id',$request->linea_id)->get();

        foreach ($propietario_lineas as $prop) {
            $prop->actual = false;
            $prop->save();
        }

        $propietarioLinea = PropietarioLinea::create($data);

        DB::commit();

        return $this->showOne($propietarioLinea,201);
    }

    public function show(PropietarioLinea $propietarioLinea)
    {
        return $this->showOne($propietarioLinea);
    }

    public function update(Request $request, propietarioLinea $propietarioLinea)
    {

    }

    public function destroy(PropietarioLinea $propietarioLinea)
    {
        $propietarioLinea->delete();
        return $this->showOne($propietarioLinea);
    }
}
