<?php

use App\MarcaTransporte;
use Illuminate\Database\Seeder;

class MarcaTransporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new MarcaTransporte();
        $data->nombre = 'Hyunday';
        $data->save();

        $data = new MarcaTransporte();
        $data->nombre = 'Masesa';
        $data->save();
    }
}
