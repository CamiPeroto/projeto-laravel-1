<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showForgotPassword()
    {
        return view ('login.forgotPassword');
    }

    public function submitForgotPassword(Request $request)
    { 

        //Validar o formulário
        $request -> validate([
            'email' => 'required|email',
        ],
        [
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'Necessário enviar um e-mail válido'
            ]
    
    );
        //Verificar se existe o usuário no banco de dados com o e-mail
        $user = User::where('email', $request->email)->first();
        //Verificar se encontrou o usuário
        if(!$user){
            //Salvar log
            Log::warning('Tentativa de recuperar senha com um email não cadastrado. ',
             ['email' => $request->email]);

            //Redirecionar o usuário, enviar mensagem de erro
            return back()->withInput()->with('error', 'E-mail não encontrado!' );
        }
        try{

            //Salvar o token recuperar senha e enviar e-mail
            $status = Password::sendResetLink(
                $request->only('email')
            );
            //Salvar log
            Log::info('Recuperar senha. ', ['status' => $status, 'email'=> $request->email]);
            
            //Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('login.index')->with('success', 'Enviado e-mail com instruções para 
            recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha' );
                
      
         

        }catch(Exception $e){
           
            //Salvar log
            Log::warning('Erro recuperar senha. ', ['error' => $e->getMessage(),
            'email'=> $request->email]);
            //Redirecionar o usuário, enviar mensagem de erro
            return back()->withInput()->with('error', 'Tente novamente mais tarde!' );

        }
     }

     public function showResetPassword(Request $request)
     {
        return view ('login.resetPassword', ['token' => $request->token]);
     }

     public function submitResetPassword(Request $request)
     {
        $request -> validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|confirmed',
        ]);

        try{
            //parei aos 11 min

        }catch (Exception $e){
            Log::warning('Erro ao atualizar senha. ', ['error' => $e->getMessage(),
        'email' => $request->email]);

            //Redirecionar o usuário
            return back()->withInput()->with('error', 'Tente novamente mais tarde');

        }
     }

}
