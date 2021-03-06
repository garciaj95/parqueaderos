<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use App\Models\Modelo;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Modelo::with(['marca'])->orderBy('descripcion', 'asc')->get();
        return $marcas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validar = $request->validate([
            'descripcion' => 'required|string|unique:'. Modelo::class .',descripcion',
            'marca_id' => 'required|exists:'. Marca::class .',id|integer',
        ]);

        $modelo = Modelo::create( $validar );

        return response()->json(['modelo' => $modelo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Modelo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validar = $request->validate([
            'descripcion' => 'required|string|unique:'. Modelo::class .',descripcion,'.$id,
            'marca_id' => 'required|exists:'. Marca::class .',id|integer',
        ]);

        $modelo = Modelo::find($id);
        $modelo->update( $validar );

        return response()->json(['modelo' => $modelo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Modelo::destroy($id);
    }

    public function getByMarca( Request $request )
    {
        $datos = $request->validate([
            'marca_id' => 'required|integer'
        ]);

        return Modelo::where('marca_id', $datos['marca_id'])->get();
    }
}
