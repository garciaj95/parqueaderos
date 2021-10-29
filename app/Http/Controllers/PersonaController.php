<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'identificacion' => 'required|string|unique:'. Persona::class .',identificacion',
            'nombres'        => 'required|string',
            'email'          => 'required|email',
        ]);

        $persona = Persona::create( $validar );

        return $persona;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::where('identificacion', $id)->first();

        return $persona;
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
            'identificacion' => 'required|string|unique:'. Persona::class .',identificacion,'.$id,
            'nombres'        => 'required|string',
            'email'          => 'nullable|email',
        ]);

        $persona = Persona::find($id);
        $persona->update( $validar );

        return response()->json(['persona' => $persona]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listadoWithVehiculos()
    {
        $listado = Persona::with('vehiculos')->get();
        /*
        $listado = DB::table('persona')
                    ->join('vehiculo', 'persona.identificacion', '=', 'vehiculo.propietario_id', 'left')
                    ->select('*')
                    ->get();
                    */

        return $listado;
    }
}
