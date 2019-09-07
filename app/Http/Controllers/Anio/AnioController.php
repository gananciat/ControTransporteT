<?php

namespace App\Http\Controllers\Anio;

use App\Anio;
use App\ConceptoPagoAnio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class AnioController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.configuracion.anio');
    }

    public function index()
    {
        $anios = Anio::with('concepto_pago_anios.concepto_pago')->get();
        return $this->showAll($anios);
    }

    public function store(Request $request)
    {
        $reglas = [
            'anio' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();

        DB::beginTransaction();
            $anio = Anio::create($data);
            foreach ($request->cuotas as $cuota_r) {
                $cuota = new ConceptoPagoAnio;
                $cuota->anio_id = $anio->id;
                $cuota->concepto_pago_id = $cuota_r['id'];
                $cuota->cuota = $cuota_r['cuota'];
                $cuota->save();
            }

        DB::commit();

        return $this->showOne($anio,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Anio $anio)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $anio->anio = $request->anio;

         if (!$anio->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $anio->save();
        return $this->showOne($anio);
    }

    public function destroy(Anio $anio)
    {
        $anio->delete();

        return $this->showOne($anio);
    }
}
