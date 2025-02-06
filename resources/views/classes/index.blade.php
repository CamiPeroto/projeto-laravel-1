@extends('layouts.admin')

 @section('content')
    
    <h2>Listar as Aulas</h2>
    <a href="{{ route('course.index') }}">
        <button type="submit">Cursos</button>    
    </a><br> <br>  
 
    <x-alert />
    
    @forelse ($classes as $classe)<br>
        ID: {{ $classe->id }}<br>
        Nome: {{ $classe->name }}<br>
        Ordem: {{$classe->order_classe}}<br>
        Descrição: {{ $classe->description }}<br>
        Curso: {{ $classe->course->name }}<br>
        Cadastrado: {{\Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s')}}<br>
        Editado: {{\Carbon\Carbon::parse($classe->updated_at)->format('d/m/Y H:i:s')}}<br><br>

    @empty
      <p style="color: #f00"> Nenhuma aula encontrada!</p>
    @endforelse

 @endsection