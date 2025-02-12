    @extends('layouts.admin')

    @section('content')

    <h2>Cadastrar Aula</h2>

    <a href="{{ route('classe.index', ['course' => $course->id]) }}">
        <button type="submit">Listar Aulas</button>    
    </a><br> <br> 

    <x-alert />

    <form action="{{route('classe.store') }}" method="POST">
        @csrf
        @method('POST')

        <input type="hidden" name="course_id" id="course_id" value=" {{$course->id}} ">
         
        <label>Curso: </label>
        <input type="text" name ='name_course' id="name_course"  value="{{$course->name}} " disabled><br><br>

         <input type="hidden" name="course_id" id="course_id" value=" {{$course->id}} ">
         
         <label>Nome: </label>
         <input type="text" name ='name' id="name" placeholder="Nome da Aula" value="{{old('name')}}" required><br><br>

         <label>Descrição: </label><br>
         <textarea name="description" id="description" rows="4" cols="30" required> {{old('description')}}</textarea><br><br>
        
         <button type="submit">Cadastrar</button>


    </form>

    @endsection