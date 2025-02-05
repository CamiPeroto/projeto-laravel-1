@extends('layouts.admin')

 @section('content')
    <h2>Detalhes do Curso</h2>

    <a href="{{ route('courses.index') }}">
    <button type="submit">Listar</button>    
    </a><br><br>
   
    <a href="{{ route('courses.edit', ['course'=> $course->id]) }}">
        <button type="submit">Editar</button>
    </a><br><br>
    
    <form action="{{route('courses.destroy', ['course' =>$course->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar o registro ?')">Apagar</button>
    </form><br>

    @if (session('success'))
    <p style ="color: #082" >
       {{ session('success') }}
    </p>
@endif
    
    ID: {{$course->id}} <br>
    Nome: {{$course->name}} <br>
    Preço: {{'R$ ' . number_format($course->price, 2, ',', '.')}}<br>
    Cadastrado: {{\Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s')}}<br>
    Criado em: {{\Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s')}} <br>
    Editado em: {{\Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s')}} <br>
@endsection
