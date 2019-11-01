<?php

namespace App\Http\Controllers\Linea;

use App\Linea;
use App\Transporte;
use App\LineaChofer;
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
        $this->middleware('admin')->except(['index','view']);
    }

    public function view()
    {
       return view('layout.transportes.linea');
    }

    public function index()
    {
        $lineas = Linea::with('ruta.ubicacion','ruta.destino','tipo_transporte','propietarios.propietario','transportes','pilotos.chofer')->get();

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

            $transporte = Transporte::create(
                [
                    'placa' => $request->placa,
                    'model' => $request->modelo,
                    'marca_transporte_id' => $request->marca_transporte_id,
                    'no_tarjeta' => $request->no_tarjeta,
                    'no_seguro' => $request->no_seguro,
                    'linea' => $request->linea,
                    'no_motor' => $request->no_motor,
                    'no_chasis' => $request->no_chasis,
                    'color' => $request->color,
                    'modelo' => $request->modelo,
                    'linea_id' => $linea->id,
                    'linea_transporte' => $request->linea_transporte
                ]
            );

            $linea_propietario = PropietarioLinea::create(
                ['propietario_id' => $request->propietario_id,
                 'linea_id' => $linea->id
                ]
            );

            $chofer_actual = LineaChofer::where('chofer_id',$request->chofer_titular)->first();

            if($chofer_actual !== null){
                $chofer_actual->actual = false;
                $chofer_actual->save();
            }

            $linea_chofer_titutar = LineaChofer::create(
                ['chofer_id' => $request->chofer_titular,
                'linea_id' => $linea->id,
                'tipo_chofer' => 'T']
            );

            if($request->chofer_suplente !== null){

                $chofer_s = LineaChofer::where('chofer_id',$request->chofer_suplente)->first();

                if($chofer_s !== null){
                    $chofer_s->actual = false;
                    $chofer_s->save();
                }

                $linea_transporte_suplente = LineaChofer::create(
                    ['chofer_id' => $request->chofer_suplente,
                     'linea_id' => $linea->id,
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
        $pagos = $linea->propietarios()->with('pagos')->get()->pluck('pagos')->collapse();

        if(count($pagos)) return $this->errorResponse("no se puede eliminar linea, ya se han realizado pagos",422);

        $linea->delete();

        return $this->showOne($linea);
    }
}
