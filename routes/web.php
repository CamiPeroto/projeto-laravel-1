<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//Login
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process'); 
//Sair do sistema
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy'); 
//Cadastrar usuário no sistema
Route::get('/create-user-login', [LoginController::class, 'create'])->name('login.create-user');
Route::post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');


//Rotas privadas
Route::group(['middleware' => 'auth'], function()
{
// Dashboard
Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index'); 
// Rota, método pra criar na controller e nome de referência p/ view
// //Usuários
Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
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

}); //fim do middleware