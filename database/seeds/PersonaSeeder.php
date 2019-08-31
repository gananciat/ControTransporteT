<?php

use App\Persona;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    public function run()
    {
        $data = new Persona();
        $data->cui = '123456789';
        $data->nombre_uno = 'Kemberly';
        $data->nombre_dos = '';
        $data->apellido_uno = 'Esquite';
        $data->apellido_dos = '';
        $data->email = 'admin@admin.com';
        $data->fecha_nac = '1994-06-15';
        $data->tipo_persona_id = 1;
        $data->save();
    }
}
