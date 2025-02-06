@extends('layouts.admin')

 @section('content')
 <h2>Cadastrar o Curso</h2>

 <a href="{{ route('course.index') }}">
   <button type="submit">Listar</button>   
</a><br> <br>

<x-alert />

 <form action="{{route('course.store') }}" method="POST">
    @csrf
    @method('POST')
    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome do Curso" value="{{old('name')}}" required><br><br>

    <label>Preço: </label>
    <input type="text" name="price" id="price" placeholder="Preço do Curso: 2.47" value="{{old('price')}}" required><br><br>

    <button type="submit">Cadastrar</button>
 </form>
@endsection