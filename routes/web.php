<?php

use App\Livewire\Task\TaskShowComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home\Inicio;
use App\Livewire\Institution\InstitutionComponent;
use App\Livewire\Department\DepartmentComponent;
use App\Livewire\User\UserComponent;
use App\Livewire\Task\TaskComponent;
use Livewire\Livewire;
/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes(['register'=>false]);


//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', Inicio::class)->name('inicio');//->middleware(['auth']);;
Route::get('/instituciones', InstitutionComponent::class)->name('instituciones');//->middleware(['auth']);
Route::get('/departamentos', DepartmentComponent::class)->name('departamentos');//->middleware(['auth']);
Route::get('/usuarios', UserComponent::class)->name('users');//->middleware(['auth']);
Route::get('/tareas', TaskComponent::class)->name('tareas');//->middleware(['auth']);
Route::get('/tareas/{task}', TaskShowComponent::class)->name('tareas.show');//->middleware(['auth']);
