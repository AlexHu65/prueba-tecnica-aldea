<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Servicios',
                'key' => 'servicios',
            ],
            [
                'name' => 'Entretenimiento',
                'key' => 'entretenimiento',
            ],
            [
                'name' => 'Alimentación',
                'key' => 'alimentacion',
            ],
            [
                'name' => 'Ropa',
                'key' => 'ropa',
            ],
            [
                'name' => 'Cuidado Personal',
                'key' => 'cuidado.personal',
            ],
            [
                'name' => 'Regalos',
                'key' => 'regalos',
            ]
        ];

        foreach($categories as $category){
            $searching = Category::where(['key' => $category['key']])->first();
            if(!$searching){
                Category::create($category);
            }else{
                $searching->update($category);
            }
        }
    }
}
