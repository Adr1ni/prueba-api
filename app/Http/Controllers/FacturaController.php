<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
{
    public function getAll()
    {
        $facturas = Factura::all();
        return response()->json($facturas, 200);
    }

    public function getById($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }

        return response()->json($factura, 200);
    }

    public function insertFactura(Request $request){
        $validator = Validator::make($request->all(),[ 
            'empresa_id' => 'required',
            'fecha_emision' => 'required',
            'fecha_vencimiento' => 'required',
            'moneda' => 'required',
            'condicion_pago' => 'required',
            'observacion'=>'required',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response,Response::HTTP_OK);
        }

        $factura = new Factura();
        $factura->empresa_id = $request->empresa_id;
        $factura->fecha_emision = $request->fecha_emision;
        $factura->fecha_vencimiento = $request->fecha_vencimiento;
        $factura->moneda = $request->moneda;
        $factura->condicion_pago = $request->condicion_pago;
        $factura->observacion = $request->observacion;
        $factura->save();

        $response = [
            'success' => true,
            'data' => $factura
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function updateFactura(Request $request, $id){

        $validator = Validator::make($request->all(),[ 

            'moneda' => 'required',
            'condicion_pago' => 'required',
            'observacion'=>'required',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response,Response::HTTP_OK);
        }
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['message' => 'Factura no encontrada'], 404);
        }

        $factura->fecha_emision = $request->fecha_emision;
        $factura->fecha_vencimiento = $request->fecha_vencimiento;
        $factura->moneda = $request->moneda;
        $factura->condicion_pago = $request->condicion_pago;
        $factura->observacion = $request->observacion;
        $factura->save();

        return response()->json($factura, 200);
    }

    public function deleteFactura($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json(['success' => false], 404);
        }

        $factura->delete();

        return response()->json(['success' => true], 200);
    }

    public function getDetallesByFacturaId($id)
{
    $factura = Factura::with('detalles.producto')->find($id);

    if (!$factura) {
        return response()->json(['message' => 'Factura no encontrada'], 404);
    }

    // Calcular la suma de los totales de los detalles de factura
    $totalDetalles = 0;
    foreach ($factura->detalles as $detalle) {
        $totalDetalles += $detalle->total;
    }

    // Agregar la suma al array de detalles antes de enviar la respuesta
    $factura->totalDetalles = $totalDetalles;

    return response()->json($factura, 200);
}


}

