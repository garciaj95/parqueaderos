<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\VehiculoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {
    Route::resource('marcas', MarcaController::class);
    Route::resource('modelos', ModeloController::class);
    Route::resource('tipos', TipoVehiculoController::class);
    Route::resource('persona', PersonaController::class);
    Route::resource('vehiculo', VehiculoController::class);

    Route::get('listado-propietarios', [PersonaController::class, 'listadoWithVehiculos']);
    Route::post('busca-vehiculos', [VehiculoController::class, 'buscaVehiculos']);

    Route::get('vehiculos-by-marca', [VehiculoController::class, 'buscaVehiculosByMarca']);

});