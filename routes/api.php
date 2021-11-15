<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

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

Route::get( '/ping', fn () => [ 'pong' => true, ] );

// Route::get('/unauthenticated', fn () => ['error' => 'Usuário Não Logado!'])->name('login');

Route::get('/unauthenticated', function () {
    return [ 'error' => 'Usuário Não Logado'];
})->name('login');

Route::post( '/user', [AuthController::class, 'create']);
Route::post( '/auth', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/todo', [ApiController::class, 'createTodo']);
Route::get('/todos', [ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}', [ApiController::class, 'readTodo']);
Route::put('/todo/{id}', [ApiController::class, 'updateTodo']);
Route::delete('/todo/{id}', [ApiController::class, 'deleteTodo']);


