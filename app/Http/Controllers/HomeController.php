<?php

namespace App\Http\Controllers;

use App\Anio;
use App\ConceptoPagoAnio;
use App\Linea;
use App\Multa;
use App\Pago;
use App\Ruta;
use App\TipoMulta;
use App\TipoTransporte;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('home');
    }

    public function lineas()
    {
        $labels = array();
        $informacion = array();

        $tipo_trasnporte = TipoTransporte::all();

        foreach ($tipo_trasnporte as $value) 
        {
            $lineas = Linea::where('tipo_transporte_id',$value->id)->get();

            array_push($labels,$value->nombre);
            array_push($informacion, count($lineas));
        }

        return response()->json(['grafica'=>$informacion,'label'=>$labels], 200);
    }   
    
    public function rutas()
    {
        $labels = array();
        $informacion = array();

        $ruta = Ruta::with('ubicacion','destino')->get();

        foreach ($ruta as $value) 
        {
            $lineas = Linea::where('ruta_id',$value->id)->get();

            array_push($labels,$value->ubicacion->nombre.' / '.$value->destino->nombre);
            array_push($informacion, count($lineas));
        }

        return response()->json(['grafica'=>$informacion,'label'=>$labels], 200);
    }    

    public function primer_tipo_pago()
    {
        $labels = ['Pagadas', 'Pedientes'];
        $informacion = array();

        $tipo_multa = TipoMulta::findOrfail(1);
        $multas_pagadas = Multa::where('tipo_multa_id',$tipo_multa->id)->where('pagado',true)->get();
        $multas_pedientes = Multa::where('tipo_multa_id',$tipo_multa->id)->where('pagado',false)->get();

        array_push($informacion, count($multas_pagadas));
        array_push($informacion, count($multas_pedientes));

        return response()->json(['grafica'=>$informacion,'label'=>$labels,'indicador'=>$tipo_multa->nombre], 200);
    }     

    public function segundo_tipo_pago()
    {
        $labels = ['Pagadas', 'Pedientes'];
        $informacion = array();

        $tipo_multa = TipoMulta::findOrfail(2);
        $multas_pagadas = Multa::where('tipo_multa_id',$tipo_multa->id)->where('pagado',true)->get();
        $multas_pedientes = Multa::where('tipo_multa_id',$tipo_multa->id)->where('pagado',false)->get();

        array_push($informacion, count($multas_pagadas));
        array_push($informacion, count($multas_pedientes));

        return response()->json(['grafica'=>$informacion,'label'=>$labels,'indicador'=>$tipo_multa->nombre], 200);
    } 
    
    public function pagos()
    {
        $labels = array();
        $informacion = array();

        $anio = Anio::where('anio',date('Y'))->first();

        $concepto_pago = ConceptoPagoAnio::with('concepto_pago')->where('anio_id',$anio->id)->get();
        
        foreach ($concepto_pago as $value) 
        {
            $total_pagado = 0;
            $pagos = Pago::where('concepto_pago_anio_id',$value->id)->where('anulado',false)->get();

            foreach ($pagos as $pago) 
            {
                $total_pagado += $pago->total;
            }

            array_push($labels,$value->concepto_pago->nombre);
            array_push($informacion,number_format($total_pagado));
        }

        return response()->json(['grafica'=>$informacion,'label'=>$labels], 200);
    }     
}
