<?php

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/juan',[UserController::class,'userRegister']);
Route::post('login',[UserController::class,'userLogin']);
Route::middleware(['auth:sanctum','role:super_admin'])->group(function () {
    Route::post('/create_admin', [SuperAdminController::class, 'createAdmin']);
    Route::post('/logout',[UserController::class, 'logout']);
    // Agrega otras rutas que deben ser accesibles solo para super_admin aquí
});
