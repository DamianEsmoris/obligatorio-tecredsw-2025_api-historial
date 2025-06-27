<?php

use App\Http\Controllers\TaskHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/task', [TaskHistoryController::class, 'GetAll']);
Route::get('/task/{d}', [TaskHistoryController::class, 'Get']);
Route::post('/task', [TaskHistoryController::class, 'Create']);
