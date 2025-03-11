@extends('layouts.admin')

 @section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Papel</h2>

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
                    {{-- @can('create-course')
                        <a href="{{ route('course.create') }}" class=" btn btn-success btn-sm">
                            Cadastrar <i class="fa-regular fa-square-plus"></i> </a> 
                    @endcan --}}
                </span>
            </div>

            <div class="card-body">
                <x-alert />
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th class="d-none d-sm-table-cell">ID</th>
                          <th>Nome</th>
                          <th class="text-center">Detalhes</th>
                        </tr>
                      </thead>

                      <tbody>
                            {{-- imprimir os registros --}}
                            @forelse ($roles as $role)
                            <tr>
                                    <th class="d-none d-sm-table-cell">{{$role->id}}</th>
                                    <td>{{$role->name}}</td>
                                
                                    <td class="d-md-flex flex-row justify-content-center">
                                         
                                        {{-- @can('index-classe') --}}
                                            <a href="#" 
                                                class="btn btn-info btn-sm me-1 mb-1 mb-md-0"> <i class="fa-solid fa-list"></i> Permissões </a> 
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                            @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum papel encontrado!
                              </div>
                           
                        @endforelse
                      </tbody>
                </table>

            {{-- Imprimir a paginação --}}
            {{ $roles->links() }}

            </div>
        </div>
    </div>
   
@endsection
    
 
