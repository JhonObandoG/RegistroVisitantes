<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InicioController;
use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\IngresoController;

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

Route::get('/', function () {
    return view('autenticacion');
});
Route::get('/autenticacion', [AutenticacionController::class, 'mostrarFormularioAutenticacion'])->name('mostrar.formulario.autenticacion');
Route::post('/autenticacion/procesar', [AutenticacionController::class, 'procesarAutenticacion'])->name('procesar.autenticacion');

Route::get('/formulario/{documento}', [IngresoController::class, 'mostrarFormulario'])->name('mostrar.formulario');
Route::post('/formulario/procesar', [IngresoController::class, 'procesarFormulario'])->name('procesar.formulario');

Route::get('/historial', [IngresoController::class, 'mostrarHistorial'])->name('mostrar.historial');
Route::get('/historial/filtrar', [IngresoController::class, 'filtrarHistorial'])->name('historial.filtrar');


Route::get('/agradecimiento', [IngresoController::class, 'vistaAgradecimiento'])->name('vista.agradecimiento');

Route::get('/confirmacion-salida/{documento}', [IngresoController::class, 'confirmacionSalida'])->name('vista.confirmacion.salida');
Route::post('/procesar-salida/{documento}', [IngresoController::class, 'procesarSalida'])->name('procesar.salida');

