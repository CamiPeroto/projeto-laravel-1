<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //Listar os usuários
    public function index(Request $request)
    {
       //Recuperar os registros do banco     
    // $users = User::orderByDesc('created_at')->paginate(10);
    $users = User::when($request->has('name'), function ($whenQuery) use ($request){
        $whenQuery->where('name', 'like', '%' . $request->name . '%');
    })
    ->when($request->has('email'), function ($whenQuery) use ($request){
        $whenQuery->where('email', 'like', '%' . $request->email . '%');
    })
    ->orderByDesc('created_at')
    ->paginate(10)
    ->withQueryString();

    return view(   'users.index',[
        'menu' => 'users',
        'users' => $users,
        'name' => $request->name,
        'email' => $request->email,
    ]);
    }

    public function show(User $user)
    {
        return view ('users.show', ['menu' => 'users', 'user' => $user]);
    }

    public function create()
    {
        //Recuperar os papéis
        $roles = Role::pluck('name')->all();

        return view ('users.create', ['menu' => 'users', 'roles' => $roles]);
    }

    public function store(UserRequest $request)
    {
        //Validar o formulário
        $request ->validated();
        // Marca o ponto inicial da transação
        DB::beginTransaction();

        try {

            // Cadastrar no banco de dados na tabela usuários
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            //Cadastrar o papel para o usuário
            $user ->assignRole($request->roles);

            // Salvar log
            Log::info('Usuário cadastrado.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }
     
    // Carregar o formulário editar usuário
     public function edit(User $user)
     {
          //Recuperar os papéis
          $roles = Role::pluck('name')->all();

          //Recuperar o papel do usuário
          $userRoles = $user->roles->pluck('name')->first();

         // Carregar a VIEW, enviar os papéis para a view
         return view('users.edit', ['menu' => 'users', 'user' => $user, 'roles' => $roles, 'userRoles'=> $userRoles]);
     }

     // Editar no banco de dados o usuário
    public function update(UserRequest $request, User $user)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

             //Editar o papel para o usuário
             $user ->syncRoles($request->roles);

            // Salvar log
            Log::info('Usuário editado.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Usuário editado com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não editado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não editado!');
        }
    }

    // Carregar o formulário editar senha do usuário
    public function editPassword(User $user)
    {

        // Carregar a VIEW
        return view('users.editPassword', ['menu' => 'users', 'user' => $user]);
    }
    
    // Editar no banco de dados a senha do usuário
    public function updatePassword(Request $request, User $user)
    {

        // Validar o formulário
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $user->update([
                'password' => $request->password,
            ]);

            // Salvar log
            Log::info('Senha do usuário editada.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Senha do usuário editada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Senha do usuário não editada.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Senha do usuário não editada!');
        }
    }

    // Excluir o usuário do banco de dados
    public function destroy(User $user)
    {
        try {
            // Excluir o registro do banco de dados
            $user->delete();

            //Remover todos os papéis atribuídos ao usuário
            $user->syncRoles([]);

            // Salvar log
            Log::info('Usuário excluído.', ['id' => $user->id, 'action_user_id' =>Auth::id() ]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não excluído.', ['error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('course.index')->with('error', 'Usuário não excluído!');
        }
    }


} //end
