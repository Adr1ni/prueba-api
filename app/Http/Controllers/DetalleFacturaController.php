<?php

namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DetalleFacturaController extends Controller
{
    public function getAll()
    {
        $detallesFactura = DetalleFactura::all();
        return response()->json($detallesFactura, 200);
    }

    public function getById($id)
    {
        $detalleFactura = DetalleFactura::find($id);

        if (!$detalleFactura) {
            return response()->json(['message' => 'Detalle de factura no encontrado'], 404);
        }

        return response()->json($detalleFactura, 200);
    }

    public function insertDetalleFactura(Request $request)
{
    $validator = Validator::make($request->all(), [
        'factura_id' => 'required',
        'producto_id' => 'required',
        'cantidad' => 'required',
    ]);

    if ($validator->fails()) {
        $response = [
            'success' => false,
            'message' => $validator->errors(),
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    $detalleFactura = new DetalleFactura();
    $detalleFactura->fill($request->all()); 
    $detalleFactura->save();

    $response = [
        'success' => true,
        'data' => $detalleFactura,
    ];

    return response()->json($response, Response::HTTP_CREATED);
}

public function updateDetalleFactura(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'factura_id' => 'required',
        'producto_id' => 'required',
        'cantidad' => 'required',
    ]);

    if ($validator->fails()) {
        $response = [
            'success' => false,
            'message' => $validator->errors(),
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    $detalleFactura = DetalleFactura::find($id);

    if (!$detalleFactura) {
        return response()->json(['message' => 'Detalle de factura no encontrado'], 404);
    }

    $detalleFactura->fill($request->all()); 
    $detalleFactura->save();

    $response = [
        'success' => true,
        'data' => detalleFactura,
    ];

    return response()->json($response, 200);
}


    public function deleteDetalleFactura($id)
    {
        $detalleFactura = DetalleFactura::find($id);

        if (!$detalleFactura) {
            return response()->json(['success' => false], 404);
        }

        $detalleFactura->delete();

        return response()->json(['success' => true], 200);
    }

    public function getProductoByDetalleFacturaId($id)
    {
        $detalleFactura = DetalleFactura::with('producto')->find($id);

        if (!$detalleFactura) {
            return response()->json(['message' => 'Detalle de factura no encontrado'], 404);
        }

        $producto = $detalleFactura->producto;

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto, 200);
    }
}

