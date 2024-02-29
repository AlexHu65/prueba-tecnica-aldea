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
                'name' => 'Personal',
                'key' => 'personal',
            ],
            [
                'name' => 'Empresa',
                'key' => 'empresa',
            ],
            [
                'name' => 'Gasto fijo',
                'key' => 'fijo',
            ],
            [
                'name' => 'Viaticos',
                'key' => 'viaticos',
            ],
            [
                'name' => 'Dieta',
                'key' => 'dieta',
            ],
            [
                'name' => 'Restaurante',
                'key' => 'restaurante',
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
