<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class BillImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) 
        {
            $fechaCarbon = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha']));

            Bill::create([
                 'category_id' => Category::inRandomOrder()->first()->id,
                 'description' => $row['gasto'],
                 'amount' => $row['monto'],
                 'date' => $fechaCarbon->toDateString()
            ]);

        }
        
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }
}
