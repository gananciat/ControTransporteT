<?php

namespace App\Http\Controllers;

use App\Anio;
use App\Pago;
use App\Multa;
use App\TipoMulta;
use App\Inspeccion;
use App\ConceptoPagoAnio;
use Barryvdh\DomPDF\Facade as PDF;

class ReporteController extends Controller
{

    //Funciones para crear el reporte e imprimir inspecciones
    public function inspecciones()
    {
        $inspecciones = array();
        $inspeccions = Inspeccion::with('transporte','transporte','agente','inspeccion_multas.multa.causa.monto','inspeccion_multas.multa.tipo_multa')->get();

        $pdf = PDF::loadView('layout.reporte.inspeccion', compact('inspeccions'));

        return $pdf->stream('inspecciones.pdf');
    } 

    //Funciones para crear el reporte e imprimir pagos
    public function pagos()
    {
        $anio = Anio::where('anio', date('Y'))->first();
        $concepto_anio = ConceptoPagoAnio::where('anio_id', $anio->id)->with('concepto_pago')->get();

        $conceptos = array();
        $pagos = array();
        $totales = array();

        foreach ($concepto_anio as $value) 
        {
          $data['nombre'] = $value->concepto_pago->nombre;
          array_push($conceptos,$data);

          $buscar_pagos = Pago::where('concepto_pago_anio_id',$value->id)
          ->with('propietario_linea.propietario','propietario_linea.linea.tipo_transporte','concepto_pago_anio.concepto_pago', 'concepto_pago_anio.anio')
          ->get();

          $dato_total['nombre'] = $value->concepto_pago->nombre;
          $dato_total['total_general'] = 0;
          foreach ($buscar_pagos as $key => $pago) 
          {
            $data_pago['nombre'] = $pago->concepto_pago_anio->concepto_pago->nombre;
            $data_pago['correlativo'] = $key+1;
            $data_pago['no_linea'] = $pago->propietario_linea->linea->no_linea;
            $data_pago['propietario'] =  '';

            if($pago->propietario_linea->actual==1)
              $data_pago['propietario'] = $pago->propietario_linea->propietario->nombre_uno.' '.$pago->propietario_linea->propietario->apellido_uno;

            $data_pago['total'] = number_format($pago->total);
            $dato_total['total_general'] += $data_pago['total'];

            array_push($pagos,$data_pago);
          }
          array_push($totales,$dato_total);
        }

        $pdf = PDF::loadView('layout.reporte.pago', compact('conceptos','pagos','totales'));

        return $pdf->stream('pagos.pdf');
    }  

    //Funciones para crear el reporte e imprimir multas
    public function multas()
    {
        $multas_no_pagadas = array();
        $ver_no_pagadas = array();      
        $multas_pagadas = array();
        $ver_pagadas = array();
        $tipo_multas = TipoMulta::all();

        foreach ($tipo_multas as $value) 
        {
          $data['identificador'] = $value->nombre;
          $data['multa'] = $value->nombre.' - No pagadas';
          array_push($ver_no_pagadas, $data);

          $buscar_multas = Multa::where('pagado',false)
            ->where('tipo_multa_id',$value->id)
            ->with('causa.monto','transporte','inspeccion_multa.inspeccion','agente','linea_chofer.chofer','linea_chofer.linea')
            ->withTrashed()->get();

          foreach ($buscar_multas as $key => $mul) 
          {
            $data_multas['identificador'] = $value->nombre;
            $data_multas['correlativo'] = $key+1;
            $data_multas['no_multa'] = $mul->no_multa;
            $data_multas['fecha_multa'] = date('d/m/Y',strtotime($mul->fecha_multa));
            $data_multas['total_a_pagar'] = number_format($mul->total_a_pagar);
            $data_multas['causa'] = $mul->causa->nombre;
            $data_multas['placa'] = $mul->transporte->placa;
            $data_multas['no_tarjeta'] = $mul->transporte->no_tarjeta;
            $data_multas['chofer'] = '';

            if($mul->linea_chofer->actual==1)
              $data_multas['chofer'] = $mul->linea_chofer->chofer->nombre_uno.' '.$mul->linea_chofer->chofer->apellido_uno;
            
            $data_multas['agente'] = $mul->agente->nombre_uno.' '.$mul->agente->apellido_uno;
            $data_multas['info'] = 'No Pagado';

            array_push($multas_no_pagadas, $data_multas);
          }
        }

        foreach ($tipo_multas as $value) 
        {
          $data['identificador'] = $value->nombre;
          $data['multa'] = $value->nombre.' - Pagadas';
          array_push($ver_pagadas, $data);

          $buscar_multas = Multa::where('pagado',true)
            ->where('tipo_multa_id',$value->id)
            ->with('causa.monto','transporte','inspeccion_multa.inspeccion','agente','linea_chofer.chofer','linea_chofer.linea')
            ->withTrashed()->get();

          foreach ($buscar_multas as $key => $mul) 
          {
            $data_multas['identificador'] = $value->nombre;
            $data_multas['correlativo'] = $key+1;
            $data_multas['no_multa'] = $mul->no_multa;
            $data_multas['fecha_multa'] = date('d/m/Y',strtotime($mul->fecha_pago));
            $data_multas['total_a_pagar'] = number_format($mul->total_a_pagar);
            $data_multas['causa'] = $mul->causa->nombre;
            $data_multas['placa'] = $mul->transporte->placa;
            $data_multas['no_tarjeta'] = $mul->transporte->no_tarjeta;
            $data_multas['chofer'] = $mul->linea_chofer->chofer->nombre_uno.' '.$mul->linea_chofer->chofer->apellido_uno;
            $data_multas['agente'] = $mul->agente->nombre_uno.' '.$mul->agente->apellido_uno;
            $data_multas['info'] = 'No Pagado';

            array_push($multas_pagadas, $data_multas);
          }
        }       

        $pdf = PDF::loadView('layout.reporte.multa', compact('ver_pagadas','multas_pagadas','multas_no_pagadas','ver_no_pagadas'));

        return $pdf->stream('multas.pdf');
    }
}
