<?php

use App\Imports\CausaImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CausaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = Excel::import(new CausaImport, 'database/seeds/causas.xlsx', null, \Maatwebsite\Excel\Excel::XLSX);
    }
}
