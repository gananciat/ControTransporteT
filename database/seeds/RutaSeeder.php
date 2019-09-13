<?php

use App\Ruta;
use Illuminate\Database\Seeder;

class RutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Ruta();
        $data->ubicacion_id = 1;
        $data->destino_id = 1;
        $data->save();

        $data = new Ruta();
        $data->ubicacion_id = 1;
        $data->destino_id = 2;
        $data->save();

        $data = new Ruta();
        $data->ubicacion_id = 1;
        $data->destino_id = 3;
        $data->save();
    }
}
