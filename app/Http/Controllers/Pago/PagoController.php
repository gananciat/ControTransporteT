<?php

namespace App\Http\Controllers\Pago;

use App\Pago;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PagoController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.pagos.pago');
    }

    public function index()
    {
        $pagos = Pago::with('propietario_linea.propietario','propietario_linea.linea.tipo_transporte','concepto_pago_anio.concepto_pago', 'concepto_pago_anio.anio')->get();
        return $this->showAll($pagos);
    }

    public function store(Request $request)
    {
        $reglas = [
            'propietario_linea_id' => 'required',
            'concepto_pago_anio_id' => 'required',
            'total' => 'required'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $pago = Pago::create($data);

        return $this->showOne($pago,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, pago $pago)
    {
        $reglas = [
            'propietario_linea_id' => 'required|string',
            'concepto_pago_anio_id' => 'required|string',
            'total' => 'required|string',
        ];

        $this->validate($request, $reglas);

        $pago->propietario_id = $request->propietario_id;
        $pago->concepto_pago_anio_id = $request->concepto_pago_anio_id;
        $pago->total = $request->total;

         if (!$pago->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $pago->save();
        return $this->showOne($pago);
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();

        return $this->showOne($pago);
    }

    public function anular($id)
    {
        $pago = Pago::find($id);
        $pago->anulado = true;
        $pago->save();

        return $this->showOne($pago);
    }
}
