<?php

use App\MontoMulta;
use Illuminate\Database\Seeder;

class MontoMultaSeeder extends Seeder
{
    /**

     */
    public function run()
    {
        $data = new MontoMulta;
        $data->monto = 100;
        $data->porcentaje_descuento = 25;
        $data->save();

        $data = new MontoMulta;
        $data->monto = 200;
        $data->porcentaje_descuento = 25;
        $data->save();

        $data = new MontoMulta;
        $data->monto = 300;
        $data->porcentaje_descuento = 25;
        $data->save();

        $data = new MontoMulta;
        $data->monto = 400;
        $data->porcentaje_descuento = 25;
        $data->save();

        $data = new MontoMulta;
        $data->monto = 500;
        $data->porcentaje_descuento = 25;
        $data->save();

        $data = new MontoMulta;
        $data->monto = 1000;
        $data->porcentaje_descuento = 25;
        $data->save();

        $data = new MontoMulta;
        $data->monto = 5000;
        $data->porcentaje_descuento = 25;
        $data->save();

        $data = new MontoMulta;
        $data->monto = 25000;
        $data->porcentaje_descuento = 25;
        $data->save();
    }
}
