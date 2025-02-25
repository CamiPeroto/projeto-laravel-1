<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     }

}
