<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
});

require __DIR__.'/auth.php';
