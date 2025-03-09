<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
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


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{taskId}', [TaskController::class, 'updateTask']);
    Route::patch('tasks/{taskId}/assign', [TaskController::class, 'assignTask']);
    Route::patch('tasks/{taskId}/status', [TaskController::class, 'updateStatus']);
    Route::get('tasks', [TaskController::class, 'getTasks']);
    Route::get('tasks/{taskId}', [TaskController::class, 'getTaskDetails']);
});