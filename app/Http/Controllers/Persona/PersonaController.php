<?php

namespace App\Http\Controllers\Persona;

use App\Persona;
use App\TelefonoPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class PersonaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function view()
    {
       return view('layout.administracion.persona');
    }

    public function index()
    {
        $persona = Persona::with('telefonos')->get();
        return $this->showAll($persona);
    }

    public function store(Request $request)
    {
        $reglas = [
            'cui' => 'required|string',
            'nombre_uno' => 'required|string',
            'nombre_dos',
            'apellido_uno' => 'required|string',
            'apellido_dos',
            'email' => 'required|email',
            'fecha_nac' => 'required|date',
            'tipo_persona_id' => 'required|integer',
            'foto'
        ];
        
        $imagePath = '';
        if (preg_match('/^data:image\/(\w+);base64,/', $request->image_file)) {
            $data = substr($request->image_file, strpos($request->image_file, ',') + 1);
            $data = base64_decode($data);
            $imagePath = $request->nombre_uno.'_'.time().'.png';;
            Storage::disk('images')->put($imagePath, $data);
        }
        
        $this->validate($request, $reglas);

        DB::beginTransaction();
            $data = $request->all();
            $data['foto'] = $imagePath;
            $persona = Persona::create($data);

            foreach ($request->telefonos as  $tel) {
                $telefono = new TelefonoPersona();
                $telefono->persona_id = $persona->id;
                $telefono->telefono = $tel['telefono'];

                $telefono->save();
            }

        DB::commit();

        return $this->showOne($persona,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Persona $persona)
    {
        $reglas = [
            'cui' => 'required|string',
            'nombre_uno' => 'required|string',
            'nombre_dos',
            'apellido_uno' => 'required|string',
            'apellido_dos',
            'email' => 'required|email',
            'fecha_nac' => 'required|date',
            'tipo_persona_id' => 'required|integer'
        ];

        $this->validate($request, $reglas);

        DB::beginTransaction();
            $persona->cui = $request->cui;
            $persona->nombre_uno = $request->nombre_uno;
            $persona->nombre_dos = $request->nombre_dos;
            $persona->apellido_uno = $request->apellido_uno;
            $persona->apellido_dos = $request->apellido_dos;
            $persona->direccion = $request->direccion;
            $persona->fecha_nac = $request->fecha_nac;

            if($request->image_file != null || $request->image_file != ''){
                $imagePath = '';
                if (preg_match('/^data:image\/(\w+);base64,/', $request->image_file)) {
                    $data = substr($request->image_file, strpos($request->image_file, ',') + 1);
                    $data = base64_decode($data);
                    $imagePath = $request->nombre1.'_'.time().'.png';;
                    Storage::disk('images')->put($imagePath, $data);
                }
                $persona->foto = $imagePath;
            }

            $persona->telefonos()->delete(); //eliminamos los anteriores

            foreach ($request->telefonos as  $tel) {
                $telefono = new TelefonoPersona();
                $telefono->persona_id = $persona->id;
                $telefono->telefono = $tel['telefono'];

                $telefono->save();
            }

            $persona->save();
        DB::commit();
        return $this->showOne($persona);
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();
        return $this->showOne($persona);
    }
}
