<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;

//Se necesitan los 2 modelos
use App\Avion;
use App\Fabricante;
use Illuminate\Http\Request;

class FabricanteAvionController extends Controller
{

    // Configuramos en el constructor del controlador la autenticación usando el Middleware auth.basic,
    // pero solamente para los métodos de crear, actualizar y borrar.

    public function __construct()
    {
        $this->middleware('auth.basic', ['only'=>['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Ojo que recibe un id_fabricante
    public function index($id_fabricante)
    {
        // Devolverá todos los aviones.
        //return "Mostrando los aviones del fabricante con Id $idFabricante";
        $fabricante = Fabricante::find($id_fabricante);

        if(!fabricante){
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(['errors'=>array(['code'=>'404','message'=>'No se encontro ningun fabricante con ese codigo']),404]);
        }
        return response()->json(['status'=>'ok', 'data'=>$fabricante->aviones()->get()],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_fabricante)
    {
        //
        return "Se muestra formulario para crear un avion del fabricante $id_fabricante";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_fabricante)
    {
        //
        /* Necesitaremos el fabricante_id que lo recibimos en la ruta
		 #Serie (auto incremental)
		Modelo
		Longitud
		Capacidad
		Velocidad
		Alcance */

        // Primero comprobaremos si estamos recibiendo todos los campos.
        if(!$request->input('modelo')
        || !$request->input('longitud')
        || !$request->input('capacidad')
        || !$request->input('alcance')){
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para errores de validación.
            return response()->json(['errors'=>array(['code'=>'422','message'=>'Faltante de datos  para el proceso de alta'])],422);

        }
       //Buscamos el Fabricante
        $fabricante = Fabricante::find($id_fabricante);

        // Si no existe el fabricante que le hemos pasado mostramos otro código de error de no encontrado.
        if(!$fabricante){
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.

            return response()->json(['errors'=>array(['code'=>'404','message'=>'No se encuentra un fabricante con ese codigo'])],404);
        }

        // Si el fabricante existe entonces lo almacenamos.
        // Insertamos una fila en Aviones con create pasándole todos los datos recibidos.

        $nuevoAvion = $fabricante->aviones()->create($request::all());

        // Más información sobre respuestas en http://jsonapi.org/format/
        // Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un POST que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.

        $response = Response::make(json_encode(['data'=>$nuevoAvion]),201)->header('Location','http://laravel-api.local:81/aviones/'.$nuevoAvion->serie)->header('Content-Type','application/json');
        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_fabricante, $id_avion)
    {
        //
        return "Se muestra avion $id_avion del fabricante $id_fabricante";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_fabricante, $id_avion)
    {
        //
        return "Se muestra formulario para editar el avion $id_avion del fabricante $id_fabricante";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idFabricante, $idAvion)
    {
        //
    }
}
