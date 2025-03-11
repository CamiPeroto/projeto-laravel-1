<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role as ModelsRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    
    //Carregar o formulário cadastrar novo papel
    public function create()
    {
          //Carregar view 
          return view('roles.create', ['menu' => 'roles']);
    }
       // Visualizar os papéis
       public function show(Role $role){    
            //Carregar view 
            return view('roles.show', ['menu' => 'roles', 'role' => $role]);
        }

    // Cadastrar o novo curso no banco de dados
    public function store(RoleRequest $request){
        // Validar o formulário
        $request ->validated();

        //Marca o ponto inicial da transação
        DB::beginTransaction();

        try{

        // Cadastrar o novo papel no banco de dados // dd printa a linha na tela, tipo vardump
        $role = Role::create([
            'name' => $request->name,
        ]);
        //Salvar o papel no banco 
        DB::commit();

        //Salvar log
        Log::info('Papel cadastrado.', ['role_id'=>$role->id]); 

        //Redirecionar o usuário para página de cadastro, mensagem de sucesso
        return redirect()->route('role.show', $role)->with('success', 'Papel cadastrado com sucesso!');

        }catch(Exception $e){
           
            //Operação não é concluída com êxito
            DB::rollBack();
            
            //Redirecionar o usuário e enviar mensagem de erro resumida
            Log::notice('Papel não cadastrado.', ['error'=>$e->getMessage()]);
            
            return back()->withInput()->with('error', 'Papel não cadastrado!');
        }
    }
    // Listar o formulário editar curso
    public function edit(Role $role){
        //Carregar view 
        return view('roles.edit', ['menu' => 'roles', 'role' => $role]);
    }

    // Editar o registro no banco de dados
    public function update (RoleRequest $request, Role $role){
        // Validar o formulário
        $request ->validated();
       
        //Marca o ponto inicial da transação
        DB::beginTransaction();

        try{

        //Editar as informações do registro
        $role->update([
            'name' =>$request->name]);

        DB::commit();

        Log::info('Papel editado.', ['role_id'=>$role->id]); 

       return redirect()->route('role.show', ['role' =>$role->id])
       ->with('success', 'Papel editado com sucesso!');

    //    //Redirecionar o usuário para página de cadastro, mensagem de sucesso
    //    return redirect()->route('role.show', $role)
    //    ->with('success', 'Papel editado com sucesso!');
    }
    catch(Exception $e){
        //Operação não é concluída com êxito
        DB::rollBack();
        //Redirecionar o usuário e enviar mensagem de erro
        Log::notice('Papel não editado.', ['error'=>$e->getMessage()]);
        return back()->withInput()->with('error', 'Papel não editado!');
        }
    }

    // Excluir o curso do banco de dados
    public function destroy(Role $role){

        try{

            $role->delete();

            //Salvar log
            Log::info('Papel apagado.', ['role_id'=>$role->id]); 

            return redirect()->route('role.index')->with('success', 'Papel excluído com sucesso!');
        
        } catch(Exception $e){
            
            //Salvar log
            Log::info('Papel não apagado.', ['error'=>$e->getMessage()]); 

            //Redirecionar o usuário e enviar mensagem de erro
            return redirect()->route('role.index')
            ->with('error', 'Papel não foi excluído!');

        }
    
    }

}
