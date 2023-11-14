<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function getAll()
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    public function getById($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrada'], 404);
        }

        return response()->json($producto, 200);
    }

    public function insertProducto(Request $request){
        $validator = Validator::make($request->all(),[ 
            'descripcion' => 'required',
            'stock' => 'required',
            'precio_unitario' => 'required',
            'categoria' => 'required',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response,Response::HTTP_OK);
        }

        $producto = new Producto();
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->categoria = $request->categoria;
        $producto->save();

        $response = [
            'success' => true,
            'data' => $producto
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function updateProducto(Request $request, $id){

        $validator = Validator::make($request->all(),[ 
            'descripcion' => 'required',
            'stock' => 'required',
            'precio_unitario' => 'required',
            'categoria' => 'required',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response,Response::HTTP_OK);
        }
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrada'], 404);
        }

        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->categoria = $request->categoria;
        $producto->save();

        $response = [
            'success' => true,
            'producto' => $producto
        ];
        return response()->json($response, 200);
    }

    public function deleteProducto($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrada'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminada con éxito'], 200);
    }
}
