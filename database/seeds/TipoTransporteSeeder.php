<?php

use App\TipoTransporte;
use Illuminate\Database\Seeder;

class TipoTransporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new TipoTransporte();
        $data->nombre = 'Micro bus';
        $data->save();

        $data = new TipoTransporte();
        $data->nombre = 'Moto taxi';
        $data->save();
    }
}
