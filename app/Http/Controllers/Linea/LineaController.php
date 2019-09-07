<?php

namespace App\Http\Controllers\Linea;

use App\Linea;
use App\Transporte;
use App\LineaTransporte;
use App\PropietarioLinea;
use Illuminate\Http\Request;
use App\ChoferLineaTransporte;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class LineaController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.transportes.linea');
    }

    public function index()
    {
        $lineas = Linea::with('ruta.ubicacion','ruta.destino','tipo_transporte','propietarios.propietario','transportes.transporte','transportes.choferes.chofer')->get();

        return $this->showAll($lineas);
    }

    public function store(Request $request)
    {
        $reglas = [
            //validaciones de linea
            'no_linea' => 'required|integer',
            'tipo_transporte_id' => 'required|integer',
            'ruta_id' => 'required|integer',
            //validacion para asignacion de propietario
            'propietario_id' => 'required',
            //validacion para asignacion de transporte
            'placa' => 'required',
            'modelo' => 'required|integer',
            'marca_transporte_id' => 'required|integer',
            'no_tarjeta' => 'required',
            'no_seguro' => 'required',
            'linea' => 'required',
            'no_motor' => 'required',
            'no_chasis' => 'required',
            'color' => 'required',

            //validacion para asignacion de transporte
            'chofer_titular' => 'required|integer'
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();

            $data = $request->all();
            $linea = Linea::create($data);

            $transporte = Transporte::create($data);

            $linea_propietario = PropietarioLinea::create(
                ['propietario_id' => $request->propietario_id,
                 'linea_id' => $linea->id
                ],
            );

            $linea_transporte = LineaTransporte::create(
                ['linea_id' => $linea->id,
                'transporte_id' => $transporte->id],
            );

            $linea_transporte_titutar = ChoferLineaTransporte::create(
                ['chofer_id' => $request->chofer_titular,
                'linea_transporte_id' => $linea_transporte->id,
                'tipo_chofer' => 'T'],
            );


            if($request->chofer_suplente !== null){
                $linea_transporte_suplente = ChoferLineaTransporte::create(
                    ['chofer_id' => $request->chofer_suplente,
                     'linea_transporte_id' => $linea_transporte->id,
                     'tipo_chofer' => 'S']
                );
            }
        DB::commit();

        return $this->showOne($linea,201);
    }

    public function show(Linea $linea)
    {
        return $this->showOne($linea);
    }

    public function update(Request $request, linea $linea)
    {
        $reglas = [

        ];

        $this->validate($request, $reglas);

        DB::beginTransaction();

            $linea->save();
        DB::commit();
        return $this->showOne($linea);
    }

    public function destroy(linea $linea)
    {
        $linea->delete();
        return $this->showOne($linea);
    }
}
