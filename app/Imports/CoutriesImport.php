<?php

namespace App\Imports;

use App\Models\Countries;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CoutriesImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $rows)
    {
        return new Countries([
            'country_name' => $rows[0],
            'country_abbr' => $rows[1],
            'country_code' => $rows[2],
        ]);
    }
}
