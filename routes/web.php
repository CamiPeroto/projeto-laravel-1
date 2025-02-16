<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index'); 

// Rota, método pra criar na controller e nome de referência p/ view
//Cursos
Route::get('/index-course', [CourseController::class, 'index'])->name('course.index'); //listar os cursos
Route::get('/show-course/{course}', [CourseController::class, 'show'])->name('course.show'); //control + D para selecionar a mesma palavra e editar
Route::get('/create-course', [CourseController::class, 'create'])->name('course.create');
Route::post('/store-course', [CourseController::class, 'store'])->name('course.store'); //post para salvar creates
Route::get('/edit-course/{course}', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/update-course/{course}', [CourseController::class, 'update'])->name('course.update'); //put recomendado para atualizar no banco
Route::delete('/destroy-course/{course}', [CourseController::class, 'destroy'])->name('course.destroy'); // delete para apagar registros

//Aulas
Route::get('/index-classe/{course}', [ClasseController::class, 'index'])->name('classe.index');
Route::get('/show-classe/{classe}', [ClasseController::class, 'show'])->name('classe.show');
Route::get('/create-classe/{course}', [ClasseController::class, 'create'])->name('classe.create');
Route::post('/edit-classe', [ClasseController::class, 'store'])->name('classe.store');
Route::get('/edit-classe/{classe}', [ClasseController::class, 'edit'])->name('classe.edit');
Route::put('/update-classe/{classe}', [ClasseController::class, 'update'])->name('classe.update'); //put recomendado para atualizar no banco
Route::delete('/destroy-classe/{classe}', [ClasseController::class, 'destroy'])->name('classe.destroy'); // delete para apagar registros
