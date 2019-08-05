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
        $data->nombre = 'Empleado';
        $data->save();
    }
}
