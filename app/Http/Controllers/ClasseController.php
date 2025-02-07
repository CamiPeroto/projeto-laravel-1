<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index(Course $course)
    { //listar as aulas
        $classes = Classe::with('course')
        ->where('course_id', $course -> id)
        ->orderBy('order_classe')
        ->get();

        //carregar view
        return view('classes.index',['course' => $course,'classes'=>$classes]);
    }
    
    // Detalhes da aula
    public function show(Classe $classe)
    {
        // Carregar a VIEW
        return view('classes.show', ['classe' => $classe]);
    }

    public function create(Course $course)
    {
        //Carregar a view
        return view ('classes.create', ['course' => $course]);
    }

    public function store (ClasseRequest $request) //recebe os dados que vem do formulário e injeta em $request
    {
        //Validar o formulário
        $request ->validated();
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

        //Redirecionar o usuário e enviar mensagem de sucesso
        return redirect()->route('classe.index', ['course' => $request->course_id])
        ->with('success', 'Aula cadastrada com sucesso!');
    }

    //Carregar formulário para editar a aula
    public function edit(Classe $classe)
    {
        return view ('classes.edit', ['classe' => $classe]);
    }

    public function update( ClasseRequest $request, Classe $classe)
    {
        $request -> validated();

        //Editar as informações no banco
        $classe -> update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
       
        //Redirecionar o usuário e enviar mensagem de sucesso
        return redirect()->route('classe.index', ['course' => $classe->course_id])
        ->with('success', 'Aula editada com sucesso!');

    }
    public function destroy(Classe $classe)
    {
        $classe->delete();

        return redirect()->route('classe.index', ['course' => $classe->course_id])
        ->with('success', 'Aula apagada com sucesso!');
    }
}
