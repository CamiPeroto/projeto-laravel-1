<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
       
        //Carregar view de cursos
        return view('courses.index');
    }
    
    // Visualizar os cursos
    public function show(){
       
        //Carregar view 
        return view('courses.show');
    }
    
    // Carregar o formulário cadastrar novo curso
    public function create(){
       
        //Carregar view 
        return view('courses.create');
    }
    
    // Cadastrar o novo curso no banco de dados
    public function store(){
       
        dd('Cadastrar o novo curso no banco de dados');
    }
    
    // Listar o formulário editar curso
    public function edit(){
       
        //Carregar view 
        return view('courses.edit');
    }
    
    // Editar o registro no banco de dados
    public function update (){
        dd("Editar o curso no banco de dados");
    }
    
    // Excluir o curso do banco de dados
    public function destroy(){
       dd('Excluir');
    }
}
