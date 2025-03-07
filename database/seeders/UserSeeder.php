<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'camila@gmail.com.br')->first()) {
            $superAdmin = User::create([
                'name' => 'Camila',
                'email' => 'camila@gmail.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12])
            ]);
            //  Atribuir papel para o usuário
            $superAdmin->assignRole('Super Admin');
        }
        
        if (!User::where('email', 'kelly@celke.com.br')->first()) {
          $admin =  User::create([
                'name' => 'Kelly',
                'email' => 'kelly@celke.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12])
            ]);
            $admin->assignRole('Admin');
        }
        
        if (!User::where('email', 'jessica@celke.com.br')->first()) {
           $teacher = User::create([
                'name' => 'Jessica',
                'email' => 'jessica@celke.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12])
            ]);
            
            $teacher->assignRole('Professor');
        }
        
        if (!User::where('email', 'gabrielly@celke.com.br')->first()) {
           $tutor = User::create([
                'name' => 'Gabrielly',
                'email' => 'gabrielly@celke.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12])
            ]);
            $tutor->assignRole('Tutor');
        }

        if (!User::where('email', 'joice@celke.com.br')->first()) {
            $student = User::create([
                 'name' => 'Joice',
                 'email' => 'joice@celke.com.br',
                 'password' => Hash::make('123456a', ['rounds' => 12])
             ]);
             $student->assignRole('Aluno');
         }
    }
}
