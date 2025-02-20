<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
