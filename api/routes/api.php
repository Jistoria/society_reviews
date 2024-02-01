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
Route::middleware(['guest'])->group(function () {
    Route::post('register',[UserController::class,'userRegister']);
    Route::post('login',[UserController::class,'userLogin']);
});
Route::middleware(['auth:sanctum'])->group(function () {
    //detalles del usuario logeado
    Route::get('/session-details', [UserController::class, 'getSessionDetails']);
    Route::post('/logout',[UserController::class, 'logout']);
});
Route::middleware(['auth:sanctum','role:SuperAdmin'])->group(function () {
    Route::post('/create_admin', [SuperAdminController::class, 'createAdmin']);
});
