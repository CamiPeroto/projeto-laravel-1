<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
        //Recuperar os registros do banco de dados
        //$courses = Course::where('id', 1000)->get();
        $courses = Course::orderBy('id','DESC' )->get(); //recupera TODOS os registros 
        // $courses = Course::paginate(10); //recupera 10 registros

       
        //Carregar view de cursos
        return view('courses.index', ['courses'=> $courses]);
    }
    
    // Visualizar os cursos
    public function show(Course $course){
    //    dd($request->course);
    //    $course = Course::where('id', $request->course)->first(); outra forma de recuperar os registros
       
        //Carregar view 
        return view('courses.show', ['course' => $course]);
    }
    
    // Carregar o formulário cadastrar novo curso
    public function create(){
       
        //Carregar view 
        return view('courses.create');
    }
    
    // Cadastrar o novo curso no banco de dados
    public function store(Request $request){
        
        // Cadastrar o novo curso no banco de dados // dd printa a linha na tela, tipo vardump
        // dd($request->name);
        Course::create([
            'name' => $request->name
        ]);
        //Redirecionar o usuário para página de cadastro, mensagem de sucesso
        return redirect()->route('courses.create')->with('success', 'Curso cadastrado com sucesso!');
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
