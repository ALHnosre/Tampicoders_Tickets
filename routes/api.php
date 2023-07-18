<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;

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

Route::prefix('users')->group(function(){

    Route::get  ('/',       [UserController::class, 'index']);
    Route::post ('/',       [UserController::class, 'create']);
    Route::post ('/store',  [UserController::class, 'store']);
    Route::get  ('/{id}',   [UserController::class, 'show']);

});

Route::prefix('tickets')->group(function(){

    Route::get  ('/',       [TicketController::class, 'index']);
    Route::post ('/',       [TicketController::class, 'create']);
    Route::post ('/store',  [TicketController::class, 'store']);
    Route::get  ('/{id}',   [TicketController::class, 'show']);
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
