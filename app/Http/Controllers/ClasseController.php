<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    public function index(Course $course)
    { //listar as aulas
        $classes = Classe::with('course')
        ->where('course_id', $course -> id)
        ->orderBy('order_classe')
        ->get();

        //carregar view
        return view('classes.index',['menu' => 'courses', 'course' => $course,'classes'=>$classes]);
    }
    
    // Detalhes da aula
    public function show(Classe $classe)
    {
        // Carregar a VIEW
        return view('classes.show', ['menu' => 'courses', 'classe' => $classe]);
    }

    public function create(Course $course)
    {
        //Carregar a view
        return view ('classes.create', ['menu' => 'courses', 'course' => $course]);
    }

    public function store (ClasseRequest $request) //recebe os dados que vem do formulário e injeta em $request
    {
        //Validar o formulário
        $request ->validated();

        //Marca o ponto inicial da transação
        DB::beginTransaction();

        try{

        //Recuperar a última ordem da aula no curso
        $lastOrderClasse = Classe::where('course_id', $request->course_id )
        ->orderBy('order_classe', 'DESC')
        ->first();

        //Cadastrar a nova aula no banco
        Classe::create([
            'name' => $request->name,
            'description' => $request->description,
            'order_classe' => $lastOrderClasse ? $lastOrderClasse ->order_classe + 1 : 1 ,
            'course_id' => $request->course_id,

        ]);

        //Operação concluída com exito
        DB::commit();

        //Redirecionar o usuário e enviar mensagem de sucesso
        return redirect()->route('classe.index', ['course' => $request->course_id])
        ->with('success', 'Aula cadastrada com sucesso!');
        }  catch(Exception $e){

        //Operação não é concluída com êxito
        DB::rollBack();

        //Redirecionar o usuário e enviar mensagem de erro
        return back()->withInput()->with('error', 'Aula não editada!');
    
    }
}

    //Carregar formulário para editar a aula
    public function edit(Classe $classe)
    {
        return view ('classes.edit', 
        ['menu' => 'courses', 'classe' => $classe,
        'course' => $classe->course // Passa o curso relacionado
    
    ]);
    }

    public function update( ClasseRequest $request, Classe $classe)
    {
        $request -> validated();

        //Marca o ponto inicial da transação
        DB::beginTransaction();

        try{

        //Editar as informações no banco
        $classe -> update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
         //Operação concluída com exito
         DB::commit();

        }catch(Exception $e){
        //Operação não é concluída com êxito
        DB::rollBack();
        //Redirecionar o usuário e enviar mensagem de erro          
          return back()->withInput()->with('error', 'Aula não cadastrada!');
        }
       
        //Redirecionar o usuário e enviar mensagem de sucesso
        return redirect()->route('classe.index', ['course' => $classe->course_id])
        ->with('success', 'Aula editada com sucesso!');

    }

    public function destroy(Classe $classe)
    {
        try{
            $classe->delete();
        
            //Redirecionar o usuário e enviar mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $classe->course_id])
            ->with('success', 'Aula apagada com sucesso!');
       
        }catch(Exception $e){
            
            //Redirecionar o usuário e enviar mensagem de erro
            return redirect()->route('classe.index', ['course' => $classe->course_id])
            ->with('error', 'Aula não foi apagada!');

        }
      
    }
}
