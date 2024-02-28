<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $searching = \App\Models\User::first();

        if(!$searching){
            \App\Models\User::factory(1)->create();
        }
    }
}
