<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function(){
    return ['pong' => true];
});

/* Route::prefix('/tarefas')->group(function(){

    Route::get('/', [TarefasController::class, 'list']); // Listagem de tarefas 

    Route::get('add', [TarefasController::class, 'add']); // Tela de adição 
    Route::post('add', [TarefasController::class, 'addAction']); // Ação de adição  

    Route::get('edit/{id}', [TarefasController::class, 'edit']); // Tela de edição 
    Route::post('edit/{id}', [TarefasController::class, 'editAction']); // Ação de edição 

    Route::get('delete/{id}', [TarefasController::class, 'del']); // Ação de deletar 

    Route::get('marcar/{id}', [TarefasController::class, 'done']); // Marcar resolvido/não
}); */

Route::post('/adicionarTarefa', [TarefasController::class, 'addAction']); // Ação de adição
Route::get('/listarTarefas', [TarefasController::class, 'list']); // Listagem de tarefas
Route::get('/listarTarefas/{id}', [TarefasController::class, 'listar']); // Listagem de tarefas por ID
Route::put('/editarTarefa/{id}', [TarefasController::class, 'editAction']); // Ação de edição
