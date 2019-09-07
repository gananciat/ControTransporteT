<?php

use App\TipoPersona;
use Illuminate\Database\Seeder;

class TipoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new TipoPersona();
        $data->nombre = 'Secretaria';
        $data->save();

        $data = new TipoPersona();
        $data->nombre = 'Propietarios';
        $data->save();

        $data = new TipoPersona();
        $data->nombre = 'Pilotos';
        $data->save();

        $data = new TipoPersona();
        $data->nombre = 'Agentes';
        $data->save();
    }
}
