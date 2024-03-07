<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonajeController;
use App\Http\Controllers\UserController;
use App\Mail\ContactanosMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('contactanos/{email}', [UserController::class, 'enviarEmail'])->name('contactanos');

Route::get('seguridad/{email}', [UserController::class, 'enviarEmailSeguridad'])->name('email.seguridad');

Route::get('/inicio', [UserController::class, 'login'])->name('inicioSesion');

Route::get('registro', [UserController::class, 'create'])->name('usuario.registro');

Route::post('registro/store', [UserController::class, 'store'])->name('usuario.registro.store');

Route::get('sesion/comprobar', [UserController::class, 'comprobarUser'])->name('usuario.comprobar');

Route::get('index', [PersonajeController::class, 'index'])->name('pagina.index');

Route::get('formulario', [PersonajeController::class, 'formulario'])->name('show.formulario');

Route::post('formulario/guardar', [PersonajeController::class, 'guardarPersonaje'])->name('personaje.guardar');

Route::get('personaje/mostrar/{id}', [PersonajeController::class, 'showPersonaje'])->name('personaje.mostrar');

Route::get('personaje/editar/{id}', [PersonajeController::class, 'editarPersonaje'])->name('personaje.editar');

Route::put('personaje/update/{id}', [PersonajeController::class, 'updatePersonaje'])->name('personaje.update');

Route::delete('personaje/eliminar/{id}', [PersonajeController::class, 'eliminarPersonaje'])->name('personaje.eliminar');


require __DIR__ . '/auth.php';
