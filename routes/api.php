<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EndCustomerController;
use App\Http\Controllers\Api\ValueRecordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rotas protegidas por autenticação de API (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    // Informações do parceiro autenticado
    Route::get('/partner', function (Request $request) {
        return response()->json($request->user());
    });

    // Gerenciamento de clientes finais
    Route::apiResource('customers', EndCustomerController::class);

    // Gerenciamento de registros de valores
    Route::apiResource('records', ValueRecordController::class);
});
