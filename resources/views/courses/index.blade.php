@extends('layouts.admin')

 @section('content')
    <h2>Listar os cursos</h2>
    
    <a href="{{ route('course.create') }}">
        <button type="submit">Cadastrar</button>    
    </a><br> <br>  
    
    <x-alert />

    {{-- imprimir os registros --}}
    @forelse ($courses as $course)
    ID: {{$course->id}}<br>
    Nome: {{$course->name}}<br>
    Preço: {{'R$ ' . number_format($course->price, 2, ',', '.')}}<br>
    Cadastrado: {{\Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s')}}<br>
    Editado: {{\Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s')}}<br><br>

    <a href="{{ route('classe.index', ['course'=> $course->id]) }}">
        <button type="submit">Aulas</button>
    </a><br><br>

    <a href="{{ route('course.show', ['course'=> $course->id]) }}">
        <button type="submit">Visualizar</button>
    </a><br><br>

    <a href="{{ route('course.edit', ['course'=> $course->id]) }}">
        <button type="submit">Editar</button>
    </a><br><br>

    <form action="{{route('course.destroy', ['course' =>$course->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar o registro ?')">Apagar</button>
    </form>

    <hr>
        
    @empty
        <p style="color: #f00"> Nenhum curso encontrado!</p>
    @endforelse
    {{-- imprimir a paginação --}}
    {{-- {{$courses->links()}} --}}
    
    {{-- {{dd($courses)}} --}}
@endsection
    
 
