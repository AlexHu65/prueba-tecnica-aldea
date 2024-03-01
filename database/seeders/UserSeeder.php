<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $searching = \App\Models\User::first();
        
        if(!$searching){
            //Crear 2 usuarios predefinidos
            $first = User::create([
                'name' => 'Alejandro',
                'email' => 'alejandrotsu23@gmail.com',
                'password' => Hash::make('12345'), // password
                'email_verified_at' => now(),
            ]);

            $second = User::create([
                'name' => 'Jorge',
                'email' => 'jorge@getaldea.com',
                'password' => Hash::make('12345'), // password
                'email_verified_at' => now(),
            ]);
            
            \App\Models\User::factory(1)->create();
        }
    }
}
