@extends('layouts.admin')

 @section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Curso</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class= "text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Cursos</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span >Listar</span>
                <span class="ms-auto">
                    @can('create-course')
                        <a href="{{ route('course.create') }}" class=" btn btn-success btn-sm">
                            Cadastrar <i class="fa-regular fa-square-plus"></i> </a> 
                    @endcan
                </span>
            </div>

            <div class="card-body">
                <x-alert />
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th class="d-none d-sm-table-cell">ID</th>
                          <th>Nome</th>
                          <th class="d-none d-md-table-cell">Preço</th>
                          <th class="text-center">Ações</th>
                        </tr>
                      </thead>

                      <tbody>
                            {{-- imprimir os registros --}}
                            @forelse ($courses as $course)
                            <tr>
                                    <th class="d-none d-sm-table-cell">{{$course->id}}</th>
                                    <td>{{$course->name}}</td>
                                    <td class="d-none d-md-table-cell">{{'R$ ' . number_format($course->price, 2, ',', '.')}}</td>
                                    
                                    <td class="d-md-flex flex-row justify-content-center">
                                         
                                        @can('index-classe')
                                            <a href="{{ route('classe.index', ['course'=> $course->id]) }}" 
                                                class="btn btn-info btn-sm me-1 mb-1 mb-md-0"> <i class="fa-solid fa-list"></i> Aulas  </a> 
                                        @endcan
                                        @can('show-course')
                                            <a href="{{ route('course.show', ['course'=> $course->id]) }}" 
                                                class="btn btn-primary btn-sm me-1 mb-1 mb-md-0"> <i class="fa-regular fa-eye"> </i> Visualizar</a>  
                                        @endcan
                                        @can('edit-course')
                                        <a href="{{ route('course.edit', ['course'=> $course->id]) }}" 
                                            class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                                        @endcan
                                        @can('destroy-course')
                                            <form action="{{route('course.destroy', ['course' =>$course->id]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar o registro ?')"><i class="fa-regular fa-square-minus"></i> Apagar</button>
                                            </form>
                                        @endcan
                                     

                                    </td>
                                </tr>
                            @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum curso encontrado!
                              </div>
                           
                        @endforelse
                      </tbody>
                </table>

            {{-- Imprimir a paginação --}}
            {{ $courses->links() }}

            </div>
        </div>
    </div>
    {{-- imprimir os registros
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
    @endforelse --}}
   
@endsection
    
 
