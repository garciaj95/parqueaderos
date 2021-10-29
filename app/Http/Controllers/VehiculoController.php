<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarcaVehiculosResource;
use App\Models\Modelo;
use App\Models\Persona;
use App\Models\TipoVehiculo;
use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculoController extends Controller
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
            'placa'          => 'required|string|unique:'. Vehiculo::class .',placa',
            'modelo_id'      => 'required|exists:'. Modelo::class .',id|integer',
            'tipo_id'        => 'required|exists:'. TipoVehiculo::class .',id|integer',
            'anio'           => 'required|integer',
            'color'          => 'required|string',
            'detalle'        => 'nullable|string',
            'propietario_id' => 'required|string|exists:'. Persona::class .',identificacion'
        ]);

        $vehiculo = Vehiculo::create( $validar );

        return response()->json(['vehiculo' => $vehiculo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

    public function buscaVehiculos( Request $request ) 
    {
        $validar = $request->validate([
            'filtro' => 'string'
        ]);

        $filtro = $validar['filtro'];

        $listado = DB::select("SELECT 
                                V.*,
                                P.*,
                                M.descripcion AS desc_modelo,
                                MA.nombre AS desc_marca,
                                T.descripcion AS desc_tipo
                            FROM 
                                vehiculo V
                            LEFT JOIN persona P ON V.propietario_id = P.identificacion
                            LEFT JOIN modelo M ON V.modelo_id = M.id 
                            LEFT JOIN marca MA ON M.marca_id = MA.id
                            LEFT JOIN tipos T ON V.tipo_id = T.id
                        
                            WHERE 
                                V.placa LIKE '%{$filtro}%' OR
                                V.color LIKE '%{$filtro}%' OR
                                P.nombres LIKE '%{$filtro}%' ");

        return $listado;
    }

    public function buscaVehiculosByMarca( Request $request ) 
    {
        $listado = DB::select("SELECT 
                                MC.id AS id,
                                MC.nombre AS nombre,
                                (
                                    SELECT 
                                        COUNT(V.id) 
                                    FROM vehiculo V 
                                    JOIN modelo M ON M.id = V.modelo_id
                                    WHERE M.marca_id = MC.id
                                ) AS canti_vehi
                            FROM 
                                marca MC");
        
        return $listado;
    }
}
