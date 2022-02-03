<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Servicios;

class ClientesController extends Controller
{
    public function getClientes()
    {
        // Pagino los resultado de una manera mas eficiente
        $data = Clientes::orderBy('created_at', 'desc')->paginate(5);
        return response()->json($data);
    }

    public function registrarClientes(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nombrecompleto' => 'required|max:50|string',
            'ingreso' => 'required|numeric',
            'id_ciudades' => 'required|numeric',
            'edad' => 'required|numeric',
            'estado' => 'required|string|min:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'error' => $validator->errors(),
                'code' => 400
            ]);
        }

        $cliente = Clientes::create($data);

        return response()->json([
            'message' => 'Creado correctamente',
            'code' => 200
        ]);
    }

    public function getClienteId($id) {

        $cliente = Clientes::where('id', $id)->first();

        if($cliente){
            return response()->json([
                'cliente' => $cliente,
                'code' => 200
            ]);
        }
        else{
            return response()->json([
                'cliente' => 'No existe Cliente',
                'code' => 400
            ]);
        }
    }

    public function actualizarClientes(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombrecompleto' => 'required|max:50|string',
            'ingreso' => 'required|numeric',
            'id_ciudades' => 'required|numeric',
            'edad' => 'required|numeric',
            'estado' => 'required|string|min:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'No se pudo actualizar',
                'code' => 400
            ]);
        }

        $cliente = Clientes::find($request->id);

        $cliente->nombrecompleto = $request->nombrecompleto;
        $cliente->ingreso = $request->ingreso;
        $cliente->id_ciudades = $request->id_ciudades;
        $cliente->edad = $request->edad;
        $cliente->estado = $request->estado;
        $cliente->save();

        return response()->json([
            'message' => 'Cliente Actualizado',
            'code' => 200
        ]);
    }

    public function eliminarClientes(Request $request)
    {

        $cliente = Clientes::find($request->id);

        if($cliente){

            $cliente->estado = 'I';
            $cliente->save();

            return response()->json([
                'message' => 'Cliente Actualizado',
                'code' => 200
            ]);
        }
        else{
            return response()->json([
                'message' => 'No se pudo actualizar',
                'code' => 400
            ]);
        }
    }

    public function verServiciosCliente($id)
    {

        $servComplete = [];
        $cli = Clientes::find($id);

        //SELECT * FROM servicios WHERE edad >=18 AND ingreso IS NULL AND id_ciudades = 1;
        $servOne = Servicios::where('edad', '>=', 18)->whereNull('ingreso')->first();

        array_push($servComplete, $servOne);

        //SELECT * FROM servicios WHERE edad IS NULL and ingreso IS NULL AND id_ciudades = 1;
        $servTwo = Servicios::where('id_ciudades', '=', 1)
        ->whereNull('edad')
        ->whereNull('ingreso')->first();

        array_push($servComplete, $servTwo);

        $servicios = Servicios::where('edad', '>=', 15 )
        ->where('ingreso', '>=', 500 )
        ->where('ingreso', '<=', $cli->ingreso)
        ->where('id_ciudades',  $cli->id_ciudades)
        ->get()
        ->toArray();

        $ServMergeOne = array_merge($servComplete, $servicios);

        return response()->json([
            'cliente' => [
                'nombre' => $cli->nombrecompleto,
                'edad' => $cli->edad,
                'ingreso' => $cli->ingreso,
                'id_ciudades' => $cli->id_ciudades,
                'estado' => $cli->estado,
            ],
            'servicios' => $ServMergeOne,
            'code' => 200
        ]);

    }
}
