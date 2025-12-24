<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EndCustomerController;
use App\Http\Controllers\Api\ValueRecordController;
use App\Http\Middleware\AuthenticatePartnerApi;

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

// Rotas protegidas por autenticação de API via Token do Parceiro
Route::middleware(AuthenticatePartnerApi::class)->group(function () {
    
    // Informações do parceiro autenticado
    Route::get('/partner', function (Request $request) {
        return response()->json($request->user());
    });

    // Gerenciamento de clientes finais
    Route::apiResource('customers', EndCustomerController::class);
    
    // Consultar saldo do cliente
    Route::get('customers/{uuid}/balance', [EndCustomerController::class, 'balance']);

    // Gerenciamento de registros de valores
    Route::apiResource('records', ValueRecordController::class);
});

