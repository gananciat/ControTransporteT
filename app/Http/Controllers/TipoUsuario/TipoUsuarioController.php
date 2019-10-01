<?php

namespace App\Http\Controllers\TipoUsuario;

use App\TipoUsuario;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TipoUsuarioController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin');
    }

    public function view()
    {
       return view('layout.acceso.tipoUsuario');
    }

    public function index()
    {
        $tipo_usuarios = TipoUsuario::all();
        return $this->showAll($tipo_usuarios);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $tipo_usuario = TipoUsuario::create($data);

        return $this->showOne($tipo_usuario,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, TipoUsuario $tipoUsuario)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $tipoUsuario->nombre = $request->nombre;

         if (!$tipoUsuario->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $tipoUsuario->save();
        return $this->showOne($tipoUsuario);
    }

    public function destroy(TipoUsuario $tipoUsuario)
    {
        $tipoUsuario->delete();

        return $this->showOne($tipoUsuario);
    }
}
