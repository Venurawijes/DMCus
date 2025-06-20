<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerApiController;

Route::get('/customers', [CustomerApiController::class, 'index']);
Route::post('/customers', [CustomerApiController::class, 'store']);
Route::delete('/customers/{id}', [CustomerApiController::class, 'destroy']);

