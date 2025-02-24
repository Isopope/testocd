<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PersonController;

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('people', PersonController::class)->only(['index', 'show']);
Route::resource('people', PersonController::class)->except(['index', 'show'])->middleware('auth');
//Route::get('/people/create', [PersonController::class, 'create'])->name('people.create');
Route::get('/people/{id}', [PersonController::class, 'show'])->name('people.show');
Route::get('/people', [PersonController::class, 'index'])->name('people.index');







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
