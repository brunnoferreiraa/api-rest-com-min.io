<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\FotoPessoaController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\LotacaoController;
use App\Http\Controllers\ServidorEfetivoController;
use App\Http\Controllers\ServidorTemporarioController;
use App\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['api', 'auth:sanctum'])->group(function () {
    Route::post('/fotos/upload', [FotoPessoaController::class, 'upload']);
    Route::get('/fotos/{id}', [FotoPessoaController::class, 'getUrl']);
    Route::apiResource('cidades', CidadeController::class);
    Route::apiResource('enderecos', EnderecoController::class);
    Route::apiResource('pessoas', PessoaController::class);
    Route::apiResource('fotos-pessoas', FotoPessoaController::class);
    Route::apiResource('unidades', UnidadeController::class);
    Route::apiResource('lotacoes', LotacaoController::class);
    Route::apiResource('servidores-efetivos', ServidorEfetivoController::class);
    Route::apiResource('servidores-temporarios', ServidorTemporarioController::class);
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
    Route::get('/servidores-efetivos/unidade/{unidade_id}', [ServidorEfetivoController::class, 'porUnidade']);
    Route::get('/enderecos/buscar', [EnderecoController::class, 'buscarPorNome']);

});

