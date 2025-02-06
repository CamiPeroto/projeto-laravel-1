<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Classe::where('name', 'Aula 1')->first()){
            Classe::create([
                'name' => 'Aula 1',
                'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
                'order_classe' => 1,
                'course_id' => 1,
            ]);
        }
        if(!Classe::where('name', 'Aula 2')->first()){
            Classe::create([
                'name' => 'Aula 2',
                'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
                'order_classe' => 2,
                'course_id' => 1,
            ]);
        }
        if(!Classe::where('name', 'Aula 1B')->first()){
            Classe::create([
                'name' => 'Aula 1B',
                'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
                'order_classe' => 1,
                'course_id' => 2,
            ]);
        }
    }
}
