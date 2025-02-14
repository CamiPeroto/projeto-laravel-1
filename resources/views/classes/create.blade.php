@extends('layouts.admin')

 @section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Cadastrar Aula</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class= "text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="{{route('course.index') }}" class= "text-decoration-none">Curso</a>
              </li>
                <li class="breadcrumb-item active">Aula</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span >Cadastrar Aula</span>
                
                <span class="ms-auto d-sm-flex flex-row">
                        
                    <a href="{{ route('classe.index', ['course' => $course->id]) }}" 
                            class=" btn btn-info btn-sm me-1 mb-1 mb-sm-0">Listar </a>

                </span>
            </div>

            <div class="card-body">
            
                <x-alert />

                <form class="row g-3" action="{{route('classe.store') }}" method="POST">
                  @csrf
                  @method('POST')

                  <input type="hidden" name="course_id" id="course_id" value=" {{$course->id}} ">

                  <div class="col-6">
                     <label for="Curso" class="form-label">Curso: </label>
                     <input type="text" name="name_course" class="form-control" id="name_course" value="{{$course->name}} "disabled>
                   </div>
                   <div class="col-6">
                     <label for="name" class="form-label">Nome:</label>
                     <input type="text" name="name" class="form-control" id="name" placeholder="Nome da Aula" value="{{old('name')}}" required>
                   </div>
                   <div class="col-12">
                    <label for="description" class="form-label">Descrição:</label>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Descrição da aula" name="description" id="description" style="height: 120px"></textarea>
                      </div>

                     <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                   </div>


                </form>
                

            </div>

        </div>


    </div>
    
   
@endsection
    
 
