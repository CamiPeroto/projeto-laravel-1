@extends('layouts.admin')

 @section('content')
    <h2>Listar os cursos</h2>

    <a href="{{ route('courses.show') }}">Visualizar</a><br>
    <a href="{{ route('courses.create') }}">Cadastrar</a><br>   

    {{-- imprimir os registros --}}
    @forelse ($courses as $course)
    {{$course->id}}<br>
    {{$course->name}}<br>
    {{\Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s')}}<br>
    {{\Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s')}}<br>
    <hr>
        
    @empty
        <p style="color: #f00"> Nenhum curso encontrado!</p>
    @endforelse
    {{-- imprimir a paginação --}}
    {{-- {{$courses->links()}} --}}
    
    {{-- {{dd($courses)}} --}}
@endsection
    
 
