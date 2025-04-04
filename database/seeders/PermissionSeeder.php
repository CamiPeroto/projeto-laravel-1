<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $permissions = [
        ['title' => 'Listar curso', 'name' => 'index-course'],
        ['title' => 'Visualizar curso', 'name' => 'show-course'],
        ['title' => 'Criar curso', 'name' => 'create-course'],
        ['title' => 'Editar curso', 'name' => 'edit-course'],
        ['title' => 'Apagar curso', 'name' => 'destroy-course'],

        ['title' => 'Listar aulas', 'name' => 'index-classe'],
        ['title' => 'Visualizar aula', 'name' => 'show-classe'],
        ['title' => 'Criar aula', 'name' => 'create-classe'],
        ['title' => 'Editar aula', 'name' => 'edit-classe'],
        ['title' => 'Apagar aula', 'name' => 'destroy-classe'],

        ['title' => 'Listar usuários', 'name' => 'index-user'],
        ['title' => 'Visualizar usuário', 'name' => 'show-user'],
        ['title' => 'Criar usuário', 'name' => 'create-user'],
        ['title' => 'Editar usuário', 'name' => 'edit-user'],
        ['title' => 'Editar senha', 'name' => 'edit-user-password'],
        ['title' => 'Apagar usuário', 'name' => 'destroy-user'],
        ['title' => 'Gerar PDF de usuários', 'name' => 'generate-pdf-user'],

        ['title' => 'Listar papéis', 'name' => 'index-role'],
        ['title' => 'Criar papel', 'name' => 'create-role'],
        ['title' => 'Editar papel', 'name' => 'edit-role'],
        ['title' => 'Apagar papel', 'name' => 'destroy-role'],

        ['title' => 'Listar permissões do papel', 'name' => 'index-role-permission'],
        ['title' => 'Editar permissões do papel', 'name' => 'update-role-permission'],
       ];

       foreach($permissions as $permission ){
        $existingPermission = Permission::where('name', $permission['name'])->first();

        if (!$existingPermission){
            Permission::create([
                'title' => $permission['title'],
                'name' => $permission['name'],
                'guard_name' => 'web',
            ]);
        }

       }
    }
}
