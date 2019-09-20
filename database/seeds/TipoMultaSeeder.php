<?php

use App\TipoMulta;
use Illuminate\Database\Seeder;

class TipoMultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new TipoMulta;
        $data->nombre = 'Sanción';
        $data->tiempo_expira = 15;
        $data->save();

        $data = new TipoMulta;
        $data->nombre = 'Remisión';
        $data->tiempo_expira = 30;
        $data->save();
    }
}
