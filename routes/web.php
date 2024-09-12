<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

//Grupo de rotas que só são possiveis de ser acessadas por usuários autenticados
Route::middleware('auth')->group(function () {
    Route::get('/', [SiteController::class, 'home'])->name('home');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    //Projetos
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    Route::get('/projects/edit/{id}',[ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('projects/{id}',[ProjectController::class, 'update'])->name('projects.update');

    Route::get('/projects/{id}',[ProjectController::class, 'show'])->name('projects.show');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    //Tarefas
    Route::get('/projects/{id}/tasks/create',[TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks',[TaskController::class, 'store'])->name('tasks.store');

    Route::get('/tasks/edit/{id}',[TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

    Route::delete('/tasks/{id}',[TaskController::class, 'destroy'])->name('tasks.destroy');

    //Admin
    Route::get('/users',[SiteController::class, 'users'])->name('users.index');
    Route::get('/users/register',[SiteController::class, 'create_user'])->name('users.create');
    Route::post('register', [SiteController::class, 'store_user'])->name('register');
    Route::get('/users/edit/{id}', [SiteController::class, 'edit_user'])->name('users.edit');
    Route::put('/users/{id}', [SiteController::class, 'update_user'])->name('users.update');
    Route::delete('/users/{id}',[SiteController::class, 'destroy_user'])->name('users.destroy');
});

//Grupo de rotas para usuários não autenticados, não permitindo que usuários autenticados acessem
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});


