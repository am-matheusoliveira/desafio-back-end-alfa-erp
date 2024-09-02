<?php

use Illuminate\Support\Facades\Route;

# Welcome
Route::get('/', function () {
    return view('welcome'); 
});

# Rotas WMS
Route::get('/estrategia_wms/{cdEstrategia}/{dsHora}/{dsMinuto}/prioridade', [App\Http\Controllers\EstrategiaWmsController::class, 'index']);
Route::post('/estrategia_wms_insert', [App\Http\Controllers\EstrategiaWmsController::class, 'estrategia_wms_insert']);