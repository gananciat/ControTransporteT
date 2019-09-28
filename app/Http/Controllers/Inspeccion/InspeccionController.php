<?php

namespace App\Http\Controllers\Inspeccion;

use App\Linea;
use App\Multa;
use App\Inspeccion;
use App\Transporte;
use App\InspeccionMulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class InspeccionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.inspecciones.inspeccion');
    }

    public function index()
    {
        $inspeccions = Inspeccion::with('transporte','transporte','agente','inspeccion_multas.multa.causa.monto','inspeccion_multas.multa.tipo_multa')->get();

        return $this->showAll($inspeccions);
    }

    public function store(Request $request)
    {
        $reglas = [
            'numero'=> 'required|integer',
            'transporte_id'=> 'required|integer',
            'agente_id'=> 'required|integer',
            'fecha' => 'required',
            'total_llantas'=> 'required',
            'platos'=> 'required',
            'retrovisores'=> 'required',
            'antena'=> 'required',
            'silvines'=> 'required',
            'stops'=> 'required',
            'tricket'=> 'required',
            'herramienta'=> 'required',
            'placas'=> 'required',
            'radio'=> 'required',
            'bocinas_radio'=> 'required',
            'vidrios'=> 'required',
            'tapon_conbustible'=> 'required',
            'tapon_radiadior'=> 'required',
            'plumillas'=> 'required',
            'alfombras'=> 'required',
            'pidevias'=> 'required',
            'reproductor'=> 'required'
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();

            $data = $request->all();
            $inspeccion = Inspeccion::create($data);

            $transporte = Transporte::find($request->transporte_id);

            $linea = Linea::find($transporte->linea_id);
            $linea_chofer = $linea->piloto_titular_actual;

            foreach ($request->multas as $multa) {

                $multa_e = Multa::where('no_multa',$multa['no_multa'])->where('tipo_multa_id', $multa['tipo_multa_id'])->first();

                if($multa_e != null) return $this->errorResponse("numero de multa ya existe",422);

                $multa = Multa::create([
                    'no_multa' => $multa['no_multa'],
                    'causa_id' => $multa['causa_id'],
                    'fecha_multa' => $request->fecha,
                    'linea_chofer_id' => $linea_chofer->id,
                    'agente_id' => $request->agente_id,
                    'total_a_pagar' => $multa['total_a_pagar'],
                    'observacion' => $multa['observacion'],
                    'tipo_multa_id' => $multa['tipo_multa_id'],
                    'transporte_id' => $request->transporte_id
                ]);

                $inspecion_multa = InspeccionMulta::create([
                    'inspeccion_id' => $inspeccion->id,
                    'multa_id' => $multa->id
                ]);
            }

        DB::commit();

        return $this->showOne($inspeccion,201);
    }

    public function show(inspeccion $inspeccion)
    {
        return $this->showOne($inspeccion);
    }

    public function update(Request $request, inspeccion $inspeccion)
    {
        $reglas = [

        ];

        $this->validate($request, $reglas);

        DB::beginTransaction();

            $inspeccion->save();
        DB::commit();
        return $this->showOne($inspeccion);
    }

    public function destroy(Inspeccion $inspeccion)
    {
        $multas = $inspeccion->inspeccion_multas;

        DB::beginTransaction();
            foreach ($multas as $multa) {
                $m = $multa->multa;
                if($m->pagado){
                    return $this->errorResponse("no se puede eliminar inspeccion, multa o multas aplicadas por la misma ya fueron pagadas",422);
                }else{
                    $m->delete();
                }
            }

          $inspeccion->delete();
        DB::commit();
        return $this->showOne($inspeccion);
    }
}
