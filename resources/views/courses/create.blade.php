@extends('layouts.admin')

 @section('content')
 <h2>Cadastrar o Curso</h2>

 <a href="{{ route('courses.index') }}">
   <button type="submit">Listar</button>   
</a><br> <br>

<x-alert />

 <form action="{{route('courses.store') }}" method="POST">
    @csrf
    @method('POST')
    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome do Curso" value="{{old('name')}}"><br><br>

    <label>Preço: </label>
    <input type="text" name="price" id="price" placeholder="Preço do Curso: 2.47" value="{{old('price')}}"><br><br>

    <button type="submit">Cadastrar</button>
 </form>
@endsection