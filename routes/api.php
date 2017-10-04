<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// resource recibe nos parámetros(URI del recurso, Controlador que gestionará las peticiones)
Route::resource('fabricante','FabricanteController', ['except'=>['edit','create']]); //Todos los metodos menos Edit  que mostraria un formulario


// Si queremos dar  la funcionalidad de ver todos los aviones tendremos que crear una ruta específica.
// Pero de aviones solamente necesitamos solamente los métodos index y show.
// Lo correcto sería hacerlo así:
Route::resource('aviones','AvionController',[ 'only'=>['index','show'] ]); //El resto se gestionan en FabricanteAvionController


// Como la clase principal es fabricantes y un avión no se puede crear si no le indicamos el fabricante,
// entonces necesitaremos crear lo que se conoce como  "Recurso Anidado" de fabricantes con aviones.
// Definición del recurso anidado:
Route::resource('fabricante.aviones','FabricanteAvionController');
