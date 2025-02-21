<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function loginProcess(LoginRequest $request)
    {
        //Validar o formulário
        $request-> validated();

        //Validar usuário e senha com as informações do banco
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if(!$authenticated){
            //Redirecionar o usuário para a página anterior 'login', enviar mensagem de erro
            return back()->withInput()->with('error', 'Email ou senha inválidos!' );
        }
        //Redirecionar o usuário
        return redirect()->route('dashboard.index');
    }

    //Carregar o formulário cadastrar novo usuário
    public function create()
    {
        return view('login.create');
    }

    //Cadastrar o novo usuário no banco
    public function store(LoginUserRequest $request)
    {
        $request -> validated();

        DB::beginTransaction();

        try{
            //cadastrar na tabela usuários
         $user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
             // Salvar log
             Log::info('Usuário cadastrado.', ['id' => $user->id]);

             // Operação é concluída com êxito
             DB::commit();
 
             // Redirecionar o usuário, enviar a mensagem de sucesso
             return redirect()->route('login.index')->with('success', 'Usuário cadastrado com sucesso!');

        }catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
     
    }
    //Deslogar o usuário
    public function destroy()
    {
        //Deslogar o usuário
        Auth::logout();
        //Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');
    }
}
