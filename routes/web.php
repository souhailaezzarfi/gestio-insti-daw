<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\GrupController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\AlumneController;

Route::get('/', [DefaultController::class, 'home'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/guest', function () {
    return view('guest'); })->name('guest');


require __DIR__.'/auth.php';

//// Professors

Route::get('/professor/list', [ProfessorController::class, 'list'])->name('professor_list');

Route::middleware('admin')->group(function () {

Route::match(['get', 'post'], '/professor/new', [ProfessorController::class, 'new'])->name('professor_new');

Route::match(['get', 'post'], '/professor/edit/{id}', [ProfessorController::class, 'edit'])->name('professor_edit');

Route::get('/professor/delete/{id}', [ProfessorController::class, 'delete'])->name('professor_delete');

Route::get('/professor/ordenarProfessor', [ProfessorController::class, 'ordenarProfessor'])->name('professor_ordenar');
});
//// Grups 

Route::get('/grup/list', [GrupController::class, 'list'])->name('grup_list');


Route::middleware('admin')->group(function () {

Route::match(['get', 'post'], '/grup/new', [GrupController::class, 'new'])->name('grup_new');

Route::match(['get', 'post'], '/grup/edit/{id}', [GrupController::class, 'edit'])->name('grup_edit');

Route::get('/grup/delete/{id}', [GrupController::class, 'delete'])->name('grup_delete');
});


///// Moduls

Route::get('/modul/list', [ModulController::class, 'list'])->name('modul_list');

Route::middleware('admin')->group(function () {

Route::match(['get', 'post'], '/modul/new', [ModulController::class, 'new'])->name('modul_new');

Route::match(['get', 'post'], '/modul/edit/{id}', [ModulController::class, 'edit'])->name('modul_edit');

Route::get('/modul/delete/{id}', [ModulController::class, 'delete'])->name('modul_delete');

Route::get('/modul/cercaProfessor', [ModulController::class, 'cercaProfessor'])->name('modul_cercar');
});

///// Alumnes 

Route::get('/alumne/list', [AlumneController::class, 'list'])->name('alumne_list');

Route::middleware('admin')->group(function () {

Route::match(['get', 'post'], '/alumne/new', [AlumneController::class, 'new'])->name('alumne_new');

Route::match(['get', 'post'], '/alumne/edit/{id}', [AlumneController::class, 'edit'])->name('alumne_edit');

Route::get('/alumne/delete/{id}', [AlumneController::class, 'delete'])->name('alumne_delete');

Route::get('/modul/filtrarAlumne', [AlumneController::class, 'filtrarAlumne'])->name('alumne_filtrar');

Route::get('/alumne/cookieDelete', [AlumneController::class, 'cookieDelete']) ->name('cookie_delete');
});