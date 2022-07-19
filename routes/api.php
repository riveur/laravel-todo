<?php

use App\Http\Controllers\Api\TaskCategoryController as ApiTaskCategoryController;
use App\Http\Controllers\Api\TaskController as ApiTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('task-categories', ApiTaskCategoryController::class)->except(['show']);
Route::get('/task-categories/{slug}/{user_id}', [ApiTaskCategoryController::class, 'showBySlug']);

Route::apiResource('tasks', ApiTaskController::class);
Route::put('/tasks/status/{task}', [ApiTaskController::class, 'updateStatus']);
