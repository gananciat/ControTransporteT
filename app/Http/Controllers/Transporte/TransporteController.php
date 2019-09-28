<?php

namespace App\Http\Controllers\Transporte;

use App\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TransporteController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.transportes.transporte');
    }

    public function index()
    {
        $transportes = Transporte::with('linea.propietario_actual.propietario', 'linea.tipo_transporte','marca_transporte')->get();
        return $this->showAll($transportes);
    }

    public function store(Request $request)
    {
        $reglas = [
            'linea_id' => 'required|integer',
            'placa' => 'required',
            'modelo' => 'required|integer',
            'marca_transporte_id' => 'required|integer',
            'no_tarjeta' => 'required',
            'no_seguro' => 'required',
            'no_motor' => 'required',
            'no_chasis' => 'required',
            'color' => 'required'
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();
            $data = $request->all();
            $linea_tranpostes = Transporte::where('linea_id', $request->linea_id)->get();

            foreach ($linea_tranpostes as $t) {
                $t->actual = false;
                $t->save();
            }

            $transporte = Transporte::create($data);

        DB::Commit();

        return $this->showOne($transporte,201);
    }

    public function show()
    {
            
    }

    public function update(Request $request, Transporte $transporte)
    {
        $reglas = [
            'linea_id' => 'required|integer',
            'placa' => 'required',
            'modelo' => 'required|integer',
            'marca_transporte_id' => 'required|integer',
            'no_tarjeta' => 'required',
            'no_seguro' => 'required',
            'no_motor' => 'required',
            'no_chasis' => 'required',
            'color' => 'required'
        ];

        $this->validate($request, $reglas);

        $transporte->placa = $request->placa;
        $transporte->linea_id = $request->linea_id;
        $transporte->modelo = $request->modelo;
        $transporte->marca_transporte_id = $request->marca_transporte_id;
        $transporte->no_tarjeta = $request->no_tarjeta;
        $transporte->no_seguro = $request->no_seguro;
        $transporte->no_motor = $request->no_motor;
        $transporte->no_chasis = $request->no_chasis;
        $transporte->color = $request->color;

        $linea_transporte_anterior = Transporte::where('linea_id', $transporte->linea_id)->get();

        foreach ($linea_transporte_anterior as $t) {
            $t->actual = false;
            $t->save();
        }

        $linea_transporte = Transporte::where('linea_id', $request->linea_id)->get();
        foreach ($linea_transporte as $t) {
            $t->actual = false;
            $t->save();
        }

        $transporte->actual = true;

        if (!$transporte->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $transporte->save();
        return $this->showOne($transporte);
    }

    public function destroy(Transporte $transporte)
    {
        $transporte->delete();

        return $this->showOne($transporte);
    }
}
