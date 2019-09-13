<?php

use App\Destino;
use Illuminate\Database\Seeder;

class DestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Destino();
        $data->nombre = 'Casco urbano chiquimulilla';
        $data->save();

        $data = new Destino();
        $data->nombre = 'Guazacapan';
        $data->save();

        $data = new Destino();
        $data->nombre = 'Los cerritos';
        $data->save();

        $data = new Destino();
        $data->nombre = 'Casco urbano casas viejas';
        $data->save();
    }
}
