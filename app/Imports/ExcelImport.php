<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\YourModel;

class ExcelImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Modify the data as needed
        $row['column_name'] = 'new_value';

        return $row;
    }
}

