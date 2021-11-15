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

Route::get('/ping', fn () => ['pong' => true]);
Route::get('/unauthenticated', fn () => ['error' => 'Usuário não está logado'])->name('login');

Route::post('/user', [AuthController::class, 'create']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleare('auth:api')->post('/auth/logout', [AuthController::class, 'logout']);

Route::middleare('auth:api')->post('/auth/me', [AuthController::class, 'me']);

Route::middleare('auth:api')->post('/todo', [ApiController::class, 'createTodo']);
Route::get('/todos', [ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}', [ApiController::class, 'readTodo']);
Route::middleare('auth:api')->put('/todo/{id}', [ApiController::class, 'updateTodo']);
Route::middleare('auth:api')->delete('/todo/{id}', [ApiController::class, 'deleteTodo']);
