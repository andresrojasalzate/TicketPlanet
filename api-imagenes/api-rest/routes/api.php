<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImagenController;
use App\Http\Controllers\Api\AuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/images/store', [ImagenController::class, 'store'])->name('images.store');
Route::get('/images/retrieve/{type}/{imageHash}', [ImagenController::class, 'show'])->name('images.retrive');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::middleware('auth:sanctum')->delete('/logout', [AuthController::class,'logout'])->name('logout');
Route::middleware('auth:sanctum')->delete('/images/delete/{hash}/', [ImagenController::class,'destroy'])->name('logout');