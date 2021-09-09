<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('landing');
})->name('landing');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
Route::get('/landing', [App\Http\Controllers\HomeController::class, 'landing']);
Route::get('/perfil', [App\Http\Controllers\HomeController::class, 'perfil'])->name('perfil');
Route::get('/modificar', [App\Http\Controllers\HomeController::class, 'modificar'])->name('modificar');


Auth::routes(['verify' => true]);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/landing', [App\Http\Controllers\HomeController::class, 'landing'])->name('landing');
// Route::get('/perfil', [App\Http\Controllers\HomeController::class, 'perfil'])->name('perfil');
// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');



Route::get('/clasesCargadas', [App\Http\Controllers\HomeController::class, 'clasesCargadas'])->name('clasesCargadas');
Route::get('/clases', [App\Http\Controllers\HomeController::class, 'clases'])->name('clases');
Route::post('/cargarClase', [App\Http\Controllers\HomeController::class, 'cargarClase'])->name('cargarClase');
Route::post('/clase/editar', [App\Http\Controllers\HomeController::class, 'editarClase'])->name('editarClase');

Route::get('/coverage', function () {
    return redirect('coverage/index.html');
});