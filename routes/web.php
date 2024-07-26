<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

# Home
# Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# Welcome
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

# Rotas WMS
Route::get('/estrategia_wms/{cdEstrategia}/{dsHora}/{dsMinuto}/prioridade', [App\Http\Controllers\EstrategiaWmsController::class, 'index']);
Route::post('/estrategia_wms_insert', [App\Http\Controllers\EstrategiaWmsController::class, 'estrategia_wms_insert']);

# Gerar Token
Route::get('/get_token', function () {
    return csrf_token();
});

# Testando Conexão
Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return 'Conexão com o banco de dados bem-sucedida.';
    } catch (\Exception $e) {
        return 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    }
});