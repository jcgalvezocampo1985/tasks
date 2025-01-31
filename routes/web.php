<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home\Inicio;
use App\Livewire\Institution\InstitutionComponent;
use Livewire\Livewire;
/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes(['register'=>false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Livewire::setScriptRoute(function ($handle) {
    return Route::get('/your-path/livewire.js', $handle);
    });
    Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/your-path/livewire/update', $handle);
    });

Route::get('/inicio', Inicio::class)->name('inicio');
Route::get('/instituciones', InstitutionComponent::class)->name('instituciones');