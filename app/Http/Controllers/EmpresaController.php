<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    public function getAll()
    {
        $empresas = Empresa::all();
        return response()->json($empresas, 200);
    }

    public function insertEmpresa(Request $request){
        $validator = Validator::make($request->all(),[ 
            'nombre_empresa' => 'required',
            'ruc' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo_electronico' => 'required',
            'contacto'=>'required',
            'fecha_registro'=>'required',
            'activa'=>'required',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response,Response::HTTP_OK);
        }

        $empresa = new Empresa();
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->ruc = $request->ruc;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->correo_electronico = $request->correo_electronico;
        $empresa->contacto = $request->contacto;
        $empresa->fecha_registro = $request->fecha_registro;
        $empresa->activa = $request->activa;
        $empresa->save();

        $response = [
            'success' => true,
            'data' => $empresa
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function getById($id){
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }
        return response()->json([
            "data"=>$empresa
        ], Response::HTTP_OK);
    }

    public function update_empresa(Request $request, $id){
        $validator = Validator::make($request->all(),[ 
            'nombre_empresa' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correo_electronico' => 'required',
            'contacto'=>'required',
            'fecha_registro'=>'required',
            'activa'=>'required',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response,Response::HTTP_OK);
        }

        $empresa = Empresa::find($id);
        if (!$empresa) {
            return response()->json(['message' => 'Empresa no encontrada'], Response::HTTP_OK);
        }

        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->contacto = $request->contacto;
        $empresa->fecha_registro = $request->fecha_registro;
        $empresa->activa = $request->activa;
        $empresa->save();
        
        $response = [
            'success' => true,
            'data' => $empresa
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function delete_empresa($id){
        $empresa = Empresa::find($id);
        if (!$empresa) {
            return response()->json(['message' => 'Empresa no encontrada'], Response::HTTP_NOT_FOUND);
        }
        $empresa->delete();
        return response()->json(['message' => 'Empresa eliminada con éxito'], Response::HTTP_OK);
    }

    public function getEmpresaWithFacturas($id)
    {
        $empresa = Empresa::with('facturas')->find($id);

        if (!$empresa) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        return response()->json($empresa, 200);
    }
}

