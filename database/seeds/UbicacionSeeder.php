<?php

use App\Ubicacion;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Ubicacion();
        $data->nombre = 'Chiquimulilla';
        $data->save();

        $data = new Ubicacion();
        $data->nombre = 'Casas Viejas';
        $data->save();
    }
}
