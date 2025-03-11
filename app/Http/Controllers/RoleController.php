<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        //Recuperar os registros do banco de dados
        $roles = Role::orderBy('name')->paginate(40);

        //Salvar log
        Log::info('Listar papéis', ['action_user_id' => Auth::id()]);
        
        //Carregar a view
        return view ('roles.index', ['menu' => 'roles', 'roles' => $roles ]);

    }
}
