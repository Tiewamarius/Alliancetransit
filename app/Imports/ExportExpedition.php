<?php

namespace App\Imports;

use App\Models\Expeditions;
use Maatwebsite\Excel\Concerns\ToModel;

class ExportExpedition implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Expeditions([
            //
        ]);
    }
}
