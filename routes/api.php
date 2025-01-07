<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SerpApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/finance', [SerpApiController::class, 'getFinanceData']);

// use App\Http\Controllers\SerpApiController;

Route::get('/stock', [SerpApiController::class, 'getStockData']);
