<?php

namespace App\Http\Controllers\Linea;

use App\LineaChofer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class LineaChoferController extends ApiController
{
     public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $lineaChofers = LineaChofer::all();
        return $this->showAll($linea_choferes);
    }

    public function store(Request $request)
    {
        $reglas = [
            'linea_id' => 'required|integer',
            'chofer_id' => 'required|integer',
            'tipo_chofer' => 'required'
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();
        $data = $request->all();

        $lineaChofers = LineaChofer::where('linea_id',$request->linea_id)
        						   ->where('tipo_chofer', $request->tipo_chofer)->get();

        foreach ($lineaChofers as $prop) {
            $prop->actual = false;
            $prop->save();
        }

        $lineaChofer = LineaChofer::create($data);

        DB::commit();

        return $this->showOne($lineaChofer,201);
    }

    public function show(LineaChofer $lineaChofer)
    {
        return $this->showOne($lineaChofer);
    }

    public function update(Request $request, LineaChofer $lineaChofer)
    {

    }

    public function destroy(LineaChofer $lineaChofer)
    {
        $lineaChofer->delete();
        return $this->showOne($lineaChofer);
    }
}
