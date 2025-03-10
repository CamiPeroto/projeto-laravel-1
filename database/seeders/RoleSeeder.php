<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Role::where('name', 'Super Admin')->first()){
            Role::create([
                'name'=>'Super Admin',
            ]);
        }
        if (!Role::where('name', 'Admin')->first()){
          $admin = Role::create([
                'name'=>'Admin',
            ]);
        }else{
            $admin = Role::where('name', 'Admin')->first();
        }
            //Dar permissão para o papel
            $admin ->givePermissionTo([
               
                'index-course',
                'show-course',
                'create-course',
                'edit-course',
                'destroy-course',

                'index-classe',
                'show-classe',
                'create-classe',
                'edit-classe',
                'destroy-classe',

                'index-user',
                'show-user',
                'create-user',
                'edit-user',
                'edit-user-password',
                'destroy-user',
            ]);

        if (!Role::where('name', 'Professor')->first()){
          $teacher = Role::create([
                'name'=>'Professor'
            ]);
            
        }else{
            $teacher = Role::where('name', 'Professor')->first();
        }
            $teacher ->givePermissionTo([
                'index-course',
                'show-course',
                'create-course',
                'edit-course',
                'destroy-course',

                'index-classe',
                'show-classe',
                'create-classe',
                'edit-classe',
                'destroy-classe',
            ]);

        if (!Role::where('name', 'Tutor')->first()){
            $tutor =  Role::create([
                'name'=>'Tutor'
            ]);
           
      }else{
        $tutor = Role::where('name', 'Tutor')->first();
    }
        $tutor ->givePermissionTo([
            'index-course',
            'show-course',
            'edit-course',

            'index-classe',
            'show-classe',
            'edit-classe',
            
    ]);


        if (!Role::where('name', 'Aluno')->first()){
            Role::create([
                'name'=>'Aluno'
            ]);
        }else{
            $admin = Role::where('name', 'Aluno')->first();
        }

    }
}
