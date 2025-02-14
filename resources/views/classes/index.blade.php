@extends('layouts.admin')

 @section('content')

 <div class="container-fluid px-4">
    <div class="mb-1 hstack gap-2">
        <h2 class="mt-3">Listar as aulas</h2>

        <ol class="breadcrumb mb-3 mt-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="#" class= "text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('course.index')}}" class= "text-decoration-none">Cursos</a>
            </li>
            <li class="breadcrumb-item active">Aulas</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header hstack gap-2">
            <span >Listar</span>
            <span class="ms-auto">
                <a href="{{ route('course.show', ['course'=> $course->id]) }}" 
                    class=" btn btn-primary btn-sm">Curso</a>
                <a href="{{ route('classe.create', [ 'course' => $course->id ]) }}" 
                    class=" btn btn-success btn-sm">Cadastrar <i class="fa-regular fa-square-plus"></i></a>
            </span>
        </div>

        <div class="card-body">
                <x-alert />
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                      <th class="d-none d-sm-table-cell">ID</th>
                      <th class="d-none d-sm-table-cell">Curso</th>
                      <th>Nome</th>
                      <th>Ordem</th>
                      <th class="text-center">Ações</th>
                      
                    </tr>
                  </thead>

                  <tbody>

                        {{-- imprimir os registros --}}
                        @forelse ($classes as $classe)
                        <tr>
                                <th class="d-none d-sm-table-cell">{{ $classe->id }}</th>
                                <td class="d-none d-sm-table-cell">{{ $classe->course->name }}</td>
                                <td>{{ $classe->name }}</td>
                                <td>{{$classe->order_classe}}</td>
                                
                                
                                <td class="d-md-flex flex-row justify-content-center">

                                    <a href="{{ route('classe.show', ['classe' => $classe->id]) }}" 
                                    class="btn btn-info btn-sm me-1 mb-1 mb-md-0"> <i class="fa-regular fa-eye"></i> Visualizar</a>
                                
                                    <a href="{{ route('classe.edit', ['classe'=> $classe->id]) }}" 
                                    class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                                
                                    <form action="{{route('classe.destroy', ['classe' =>$classe->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar o registro ?')"><i class="fa-regular fa-square-minus"></i> Apagar</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                        <div class="alert alert-danger" role="alert">
                            Nenhuma aula encontrada!
                          </div>
                       
                    @endforelse
                  </tbody>
            </table>
        </div>
    </div>
</div>


    {{-- <h2 class="mt-3">Listar as Aulas</h2>

    <a href="{{ route('course.index') }}">
        <button type="submit">Cursos</button>    
    </a><br> <br> 

    <a href="{{ route('classe.create', [ 'course' => $course->id ]) }}">
        <button type="submit">Cadastrar</button>    
    </a><br>  
 
    <x-alert />
    
    @forelse ($classes as $classe)<br>
        ID: {{ $classe->id }}<br>
        Nome: {{ $classe->name }}<br>
        Ordem: {{$classe->order_classe}}<br>
        Descrição: {{ $classe->description }}<br>
        Curso: {{ $classe->course->name }}<br>
        Cadastrado: {{\Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s')}}<br>
        Editado: {{\Carbon\Carbon::parse($classe->updated_at)->format('d/m/Y H:i:s')}}<br><br>
       
        
        <a href="{{ route('classe.show', ['classe' => $classe->id]) }}">
            <button type="button">Visualizar</button>
        </a><br><br>

        <a href="{{ route('classe.edit', ['classe'=> $classe->id]) }}">
            <button type="submit">Editar</button>
        </a><br><br>

        <form action="{{route('classe.destroy', ['classe' =>$classe->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Tem certeza que deseja apagar o registro ?')">Apagar</button>
        </form>

    @empty
      <p style="color: #f00"> Nenhuma aula encontrada!</p>
    @endforelse --}}


 @endsection