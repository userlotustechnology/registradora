<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\EndCustomerController;
use App\Http\Controllers\ValueRecordController;

// Rotas públicas
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Rotas específicas para administradores
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/users', function () {
            return view('admin.users.index');
        })->name('admin.users.index');
        
        Route::get('/admin/settings', function () {
            return view('admin.settings.index');
        })->name('admin.settings.index');
        
        // CRUD de Parceiros
        Route::resource('admin/partners', PartnerController::class, [
            'as' => 'admin',
            'names' => [
                'index' => 'admin.partners.index',
                'create' => 'admin.partners.create',
                'store' => 'admin.partners.store',
                'show' => 'admin.partners.show',
                'edit' => 'admin.partners.edit',
                'update' => 'admin.partners.update',
                'destroy' => 'admin.partners.destroy',
            ]
        ]);
        Route::post('admin/partners/{partner}/regenerate-token', [PartnerController::class, 'regenerateToken'])
            ->name('admin.partners.regenerate-token');
        
        // CRUD de Clientes Finais
        Route::resource('admin/end-customers', EndCustomerController::class, [
            'as' => 'admin',
            'names' => [
                'index' => 'admin.end-customers.index',
                'create' => 'admin.end-customers.create',
                'store' => 'admin.end-customers.store',
                'show' => 'admin.end-customers.show',
                'edit' => 'admin.end-customers.edit',
                'update' => 'admin.end-customers.update',
                'destroy' => 'admin.end-customers.destroy',
            ]
        ]);
        
        // CRUD de Registros de Valores
        Route::resource('admin/value-records', ValueRecordController::class, [
            'as' => 'admin',
            'names' => [
                'index' => 'admin.value-records.index',
                'create' => 'admin.value-records.create',
                'store' => 'admin.value-records.store',
                'show' => 'admin.value-records.show',
                'edit' => 'admin.value-records.edit',
                'update' => 'admin.value-records.update',
                'destroy' => 'admin.value-records.destroy',
            ]
        ]);
    });
});
