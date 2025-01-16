<?php

use App\Http\Controllers\EmpleadoController;
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

$id =isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

Route::get('/', [EmpleadoController::class, 'index'])->name('empleados');

//CREAR, EDITAR, ELIMINAR
Route::get('/addEditEmpleado', [EmpleadoController::class, 'getEmpleado'])->name('addEditEmpleado');
Route::post('/addEditEmpleado/save', [EmpleadoController::class, 'saveEmpleado'])->name('saveEmpleado');
Route::post('/addEditEmpleado/delete', [EmpleadoController::class, 'deleteEmpleado'])->name('deleteEmpleado');
