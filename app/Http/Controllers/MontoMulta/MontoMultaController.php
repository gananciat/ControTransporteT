<?php

namespace App\Http\Controllers\MontoMulta;

use App\MontoMulta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class MontoMultaController extends ApiController
{
   public function __construct()
    {
        parent::__construct();
        $this->middleware('admin')->except(['index','view']);
    }

    public function view()
    {
       return view('layout.multas.montoMulta');
    }

    public function index()
    {
        $montoMultas = MontoMulta::with('causas')->get();
        return $this->showAll($montoMultas);
    }

    public function store(Request $request)
    {
        $reglas = [
            'monto' => 'required',
            'porcentaje_descuento' => 'required'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $montoMulta = MontoMulta::create($data);

        return $this->showOne($montoMulta,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, MontoMulta $montoMulta)
    {
        $reglas = [
            'monto' => 'required',
            'porcentaje_descuento' => 'required'
        ];

        $this->validate($request, $reglas);

        $montoMulta->monto = $request->monto;
        $montoMulta->porcentaje_descuento = $request->porcentaje_descuento;

         if (!$montoMulta->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $montoMulta->save();
        return $this->showOne($montoMulta);
    }

    public function destroy(MontoMulta $montoMulta)
    {
        $montoMulta->delete();

        return $this->showOne($montoMulta);
    }
}
