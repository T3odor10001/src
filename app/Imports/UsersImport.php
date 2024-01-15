<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\SapOperation;

class UsersImport implements ToModel
{
    use Importable;

    public function model(array $row): SapOperation
    {
        // Assuming your Excel file has columns corresponding to the SapOperation model's attributes.
        return new SapOperation([
            'date' => $row[0],   // Assuming the first column is 'date'
            'sum' => $row[1],    // Assuming the second column is 'sum'
            'title' => $row[2],  // Assuming the third column is 'title'
            // ...and so on for other columns
        ]);
    }
}
