<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)->group(function (){
    Route::post('/users', 'insert');
    Route::post('/login', 'login');
});

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('user-profile',[UserController::class, 'userProfile']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('/users', [UserController::class, 'all']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::get('/users/{id}', [UserController::class, 'userData']);

    Route::get('/empresas',[EmpresaController::class,'getAll']);
    Route::get('/empresas/{id}',[EmpresaController::class,'getById']);
    Route::post('/empresas',[EmpresaController::class,'insertEmpresa']);
    Route::put('/empresas/{id}',[EmpresaController::class,'update_empresa']);
    Route::delete('/empresas',[EmpresaController::class,'delete_empresa']);
    Route::get('/empresas/{id}/facturas', [EmpresaController::class,'getEmpresaWithFacturas']);

    Route::get('/facturas',[FacturaController::class,'getAll']);
    Route::get('/facturas/{id}',[FacturaController::class,'getById']);
    Route::post('/facturas',[FacturaController::class,'insertFactura']);
    Route::put('/facturas/{id}',[FacturaController::class,'updateFactura']);
    Route::delete('/facturas/{id}',[FacturaController::class,'deleteFactura']);
    Route::get('/facturas/{id}/detalle_facturas', [FacturaController::class,'getDetallesByFacturaId']);

    Route::get('/productos',[ProductoController::class,'getAll']);
    Route::get('/productos/{id}',[ProductoController::class,'getById']);
    Route::post('/productos',[ProductoController::class,'insertProducto']);
    Route::put('/productos/{id}',[ProductoController::class,'updateProducto']);
    Route::delete('/productos/{id}',[ProductoController::class,'deleteProducto']);

    Route::get('/detalles',[DetalleFacturaController::class,'getAll']);
    Route::get('/detalles/{id}',[DetalleFacturaController::class,'getById']);
    Route::post('/detalles',[DetalleFacturaController::class,'insertDetalleFactura']);
    Route::put('/detalles/{id}',[DetalleFacturaController::class,'updateDetalleFactura']);
    Route::delete('/detalles/{id}',[DetalleFacturaController::class,'deleteDetalleFactura']);
    Route::get('/detalles/{id}/producto',[DetalleFacturaController::class,'getProductoByDetalleFacturaId']);

    Route::get('/clientes',[ClienteController::class,'index']);
    Route::get('/clientes/{id}',[ClienteController::class,'show']);
    Route::post('/clientes', [ClienteController::class,'store']);
    Route::put('/clientes/{id}', [ClienteController::class,'update']);
    Route::delete('/clientes/{id}', [ClienteController::class,'destroy']);

});
