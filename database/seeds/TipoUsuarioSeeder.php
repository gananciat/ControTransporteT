<?php

use App\TipoUsuario;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new TipoUsuario();
        $data->nombre = 'administrador';
        $data->save();

        $data = new TipoUsuario();
        $data->nombre = 'usuario comun';
        $data->save();
    }
}
