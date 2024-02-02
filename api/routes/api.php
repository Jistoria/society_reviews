<?php

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TagController;
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


// para ver las rutas de resource utilice php artisan route:list
Route::get('/email/verify/{id}/{hash}', [UserController::class, 'verify']);

//Rutas que requieren que no estes autenticado
Route::middleware(['guest'])->group(function () {
    //registrarse como civil
    Route::post('register',[UserController::class,'userRegister']);
    //iniciar sesion (todos los roles deben iniciar sesion por esta ruta)
    Route::post('login',[UserController::class,'userLogin']);
});

//Rutas para cualquier Usuario
Route::middleware(['auth:sanctum'])->group(function () {
    //detalles del usuario logeado
    Route::get('/session-details', [UserController::class, 'getSessionDetails']);
    //cerrar sesion
    Route::post('/logout',[UserController::class, 'logout']);
});

//Rutas solo para Admin
Route::middleware(['auth:sanctum','role:Admin'])->group(function () {
    //Tags
    Route::resource('tag', TagController::class);
});

//Rutas solo para SuperAdmin
Route::middleware(['auth:sanctum','role:SuperAdmin'])->group(function () {
    //crear un admin
    Route::post('/create_admin', [SuperAdminController::class, 'createAdmin']);
});
