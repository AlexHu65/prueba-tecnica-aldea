<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BillImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{

    protected $user;

    public function __construct($user)
    {  
        $this->user = $user;
    }

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) 
        {
            $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha']));

            $bill = Bill::create([
                 'category_id' => Category::inRandomOrder()->first()->id,
                 'description' => $row['gasto'],
                 'amount' => $row['monto'],
                 'date' => $date->toDateString()
            ]);

            $this->user->bills()->attach($bill);
        }
        
    }

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }
}
