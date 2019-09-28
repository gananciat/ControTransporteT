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

        $data = new Persona();
        $data->cui = '123456789';
        $data->nombre_uno = 'Juan';
        $data->nombre_dos = 'Estuardo';
        $data->apellido_uno = 'Esquite';
        $data->apellido_dos = 'Revolorio';
        $data->email = 'juan@gmail.com';
        $data->fecha_nac = '1990-06-15';
        $data->tipo_persona_id = 2;
        $data->save();

        $data = new Persona();
        $data->cui = '12345456789';
        $data->nombre_uno = 'Pedro';
        $data->nombre_dos = 'Estuardo';
        $data->apellido_uno = 'Esquite';
        $data->apellido_dos = 'Revolorio';
        $data->email = 'juan@gmail.com';
        $data->fecha_nac = '1990-06-15';
        $data->tipo_persona_id = 3;
        $data->licencia = '77665456';
        $data->save();

        $data = new Persona();
        $data->cui = '123456789';
        $data->nombre_uno = 'Estuardo';
        $data->nombre_dos = 'Juan';
        $data->apellido_uno = 'Esquite';
        $data->apellido_dos = 'Revolorio';
        $data->email = 'juan@gmail.com';
        $data->fecha_nac = '1990-06-15';
        $data->tipo_persona_id = 3;
        $data->licencia = '77665876';
        $data->save();

        $data = new Persona();
        $data->cui = '123456789';
        $data->nombre_uno = 'Estuardo';
        $data->nombre_dos = '';
        $data->apellido_uno = 'Gonzalez';
        $data->apellido_dos = '';
        $data->email = 'estuardo@gmail.com';
        $data->fecha_nac = '1990-06-15';
        $data->tipo_persona_id = 4;
        $data->save();

        $data = new Persona();
        $data->cui = '123456789';
        $data->nombre_uno = 'Chepe';
        $data->nombre_dos = '';
        $data->apellido_uno = 'Leke';
        $data->apellido_dos = '';
        $data->email = 'chepe@gmail.com';
        $data->fecha_nac = '1990-06-15';
        $data->tipo_persona_id = 5;
        $data->save();
    }
}
