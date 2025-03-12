<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index(Role $role)
    {
        //Verificae se tem papel de super admin, não permitir visualizar as permissões
        if($role->name=='Super Admin'){
            //Salvar log
            Log::info('Permissões do super admin não pode ser acessada', ['action_user_id' => Auth::id()]);

            //redirecionar o usuário e enviar mensagem de erro
            return redirect()->route('role.index')->with('error', 'As permissões do super admin não podem ser acessadas!');
         }

         //Recuperar as permissões
        $rolePermissions =  DB::table('role_has_permissions')
            ->where('role_id', $role->id)
            ->pluck('permission_id')
            ->all();
        //Recuperar todas as permissões do banco de dados 
       $permissions = Permission::get();

       Log::info('Listar permissões do papel', ['role_id' => $role->id, 'action_user_id' => Auth::id()]);
       //Carregar a view
       return view('rolePermission.index', [
        'menu' => 'roles',
        'rolePermissions' => $rolePermissions,
        'permissions' => $permissions,
        'role' => $role,
       ]);
    }
}
