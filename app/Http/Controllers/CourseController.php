<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
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
    public function store(CourseRequest $request){
        // Validar o formulário
        $request ->validated();
        // Cadastrar o novo curso no banco de dados // dd printa a linha na tela, tipo vardump
        // dd($request->name);
        $course = Course::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        //Redirecionar o usuário para página de cadastro, mensagem de sucesso
        return redirect()->route('course.show', ['course' =>$course->id])->with('success', 'Curso cadastrado com sucesso!');
    }
    
    // Listar o formulário editar curso
    public function edit(Course $course){
       
        //Carregar view 
        return view('courses.edit', ['course' => $course]);
    }
    
    // Editar o registro no banco de dados
    public function update (CourseRequest $request, Course $course){
        // Validar o formulário
        $request ->validated();
        //Editar as informações do registro
        $course->update([
            'name' =>$request->name,
            'price'=>$request->price,
        ]);
       return redirect()->route('course.show', ['course' =>$course->id])
       ->with('success', 'Curso editado com sucesso!');
    }
    
    // Excluir o curso do banco de dados
    public function destroy(Course $course){
        $course->delete();
        return redirect()->route('course.index')->with('success', 'Curso excluído com sucesso');
      
    }
}
