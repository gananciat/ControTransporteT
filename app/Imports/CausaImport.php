<?php

namespace App\Imports;

use App\Causa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CausaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $data = new Causa();
            $data->monto_multa_id = $row[0];
            $data->nombre = $row[1];
            $data->save();
        }
    }
}
