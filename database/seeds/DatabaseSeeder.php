<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(TipoPersonaSeeder::class);
    	$this->call(PersonaSeeder::class);
    	$this->call(TipoUsuarioSeeder::class);
        $this->call(UserSeeder::class);
    }
}
