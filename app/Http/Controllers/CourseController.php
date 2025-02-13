<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    // Listar os cursos
    public function index(){
        //Recuperar os registros do banco de dados
        //$courses = Course::where('id', 1000)->get();
        $courses = Course::orderBy('id','ASC' )
        ->paginate(5);
        // ->get(); //recupera TODOS os registros em ordem ascendente

        // $courses = Course::paginate(10); //recupera 10 registros na paginaçãp
        

        // //Salvar log
        // Log::info('Listar cursos acessado.'); info informa o fluxo normal
       
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

        //Marca o ponto inicial da transação
        DB::beginTransaction();

        try{

        // Cadastrar o novo curso no banco de dados // dd printa a linha na tela, tipo vardump
        // dd($request->name);

        $course = Course::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);


        DB::commit();
            //Salvar log
            Log::info('Curso cadastrado.', ['course_id'=>$course->id]); 

        //Redirecionar o usuário para página de cadastro, mensagem de sucesso
        return redirect()->route('course.show', ['course' =>$course->id])->with('success', 'Curso cadastrado com sucesso!');
        }catch(Exception $e){
            //Operação não é concluída com êxito
            DB::rollBack();
            
            //Redirecionar o usuário e enviar mensagem de erro resumida
            Log::notice('Curso não cadastrado.', ['error'=>$e->getMessage()]);
            
            return back()->withInput()->with('error', 'Curso não cadastrado!');
        }
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
       
        //Marca o ponto inicial da transação
        DB::beginTransaction();

        try{

        //Editar as informações do registro
        $course->update([
            'name' =>$request->name,
            'price'=>$request->price,
        ]);

        DB::commit();

        Log::info('Curso editado.', ['course_id'=>$course->id]); 

       return redirect()->route('course.show', ['course' =>$course->id])
       ->with('success', 'Curso editado com sucesso!');
    }
    catch(Exception $e){
        //Operação não é concluída com êxito
        DB::rollBack();
        //Redirecionar o usuário e enviar mensagem de erro
        Log::notice('Curso não editado.', ['error'=>$e->getMessage()]);
        return back()->withInput()->with('error', 'Curso não editado!');
        }
    }
    
    // Excluir o curso do banco de dados
    public function destroy(Course $course){

        try{

            $course->delete();

            //Salvar log
            Log::info('Curso apagado.', ['course_id'=>$course->id]); 

            return redirect()->route('course.index')->with('success', 'Curso excluído com sucesso!');
        
        } catch(Exception $e){
            
            //Salvar log
            Log::info('Curso não apagado.', ['error'=>$e->getMessage()]); 

            //Redirecionar o usuário e enviar mensagem de erro
            return redirect()->route('course.index')
            ->with('error', 'Curso não foi excluído!');

        }

    
    
    }
}
