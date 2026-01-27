<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; 

// Rota de utilidade para o Deploy em hospedagem comparilhada
// Execute apenas uma vez acessando: seu-dominio.com/api/setup-storage
Route::get('/setup-storage', function () {
    Artisan::call('storage:link');
    return 'Link simbólico entre public e storage criado com sucesso!';
});

// Rotas públicas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas protegidas (Requerem Token Bearer)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) { 
        return $request->user(); 
    });
    
    Route::post('/upload', [ImageController::class, 'upload']);
    Route::get('/images', [ImageController::class, 'index']);
    Route::delete('/image/{filename}', [ImageController::class, 'destroy']);
});