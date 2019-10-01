<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
       $data = new User();
       $data->email = 'admin@admin.com';
       $data->password = bcrypt('admin123');
       $data->persona_id = 1;
       $data->tipo_usuario_id = 1;
       $data->save();

       $data = new User();
       $data->email = 'usuario@usuario.com';
       $data->password = bcrypt('usuario');
       $data->persona_id = 1;
       $data->tipo_usuario_id = 2;
       $data->save();
    }
}
