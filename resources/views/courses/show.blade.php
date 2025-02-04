@extends('layouts.admin')

 @section('content')
    <h2>Detalhes do Curso</h2>

    <a href="{{ route('courses.index') }}">Listar</a><br>
    <a href="{{ route('courses.edit', ['course' =>$course->id]) }}">Editar</a> <br><br>

    @if (session('success'))
    <p style ="color: #082" >
       {{ session('success') }}
    </p>
@endif
    
    ID: {{$course->id}} <br>
    Nome: {{$course->name}} <br>
    Criado em: {{\Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s')}} <br>
    Editado em: {{\Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s')}} <br>
@endsection
