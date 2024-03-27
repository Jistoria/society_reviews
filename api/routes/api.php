<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\PaginateController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
// Para ver las rutas de resource utilice php artisan route:list

//Verificar el Email
Route::get('/email/verify/{id}/{hash}', [UserController::class, 'verify']);
//PAGINACIÓN/BUSQUEDA/FILTRO
Route::post('paginate/{search?}',[PaginateController::class,'index']);



//PLUCKS
Route::get('pluck/franchise',[FranchiseController::class,'pluckFranchise']);
//Tipo de contenido
Route::get('content_type',[ReviewController::class,'pluckContenType']);
//Obtener autores de reseñas
Route::get('pluck/authors',[ReviewController::class,'pluckAuthors']);
//Obtener tags
Route::get('pluck/tags',[ReviewController::class,'pluckTags']);
//Rutas que requieren que no estes autenticado
Route::middleware(['guest:sanctum'])->group(function () {
    //registrarse como civil
    Route::post('register',[UserController::class,'userRegister']);
    //iniciar sesion (todos los roles deben iniciar sesion por esta ruta)
    Route::post('login',[UserController::class,'userLogin']);
});

//Rutas para cualquier Usuario Autenticado
Route::middleware(['auth:sanctum'])->group(function () {
    //detalles del usuario logeado
    Route::get('/take', [UserController::class, 'getSessionDetails']);
    //cerrar sesion
    Route::post('/logout',[UserController::class, 'logout']);
    //Obtener Notificaciones
    Route::get('get_notifications',[UserController::class,'getNotifications']);
    //Comentarios
    Route::resource('comment', CommentController::class)->middleware('verified');
});

//Rutas solo para Admin
Route::middleware(['auth:sanctum','role:Admin'])->group(function () {
    //Tags
    Route::resource('tag', TagController::class);
    //Franquicias
    Route::resource('franchise', FranchiseController::class);
    Route::post('franchise/{franchise}/update_tags', [FranchiseController::class,'updateTags']);
    Route::get('franchise/{franchise}/tags',[FranchiseController::class,'getTags']);

    //Reseñas
    Route::resource('review', ReviewController::class);
    Route::post('review/{review}/published', [ReviewController::class,'publishedReview']);
    // Route::post('review/{review}/notify',[ReviewController::class,'notifyReview']);

});

//Rutas solo para SuperAdmin
Route::middleware(['auth:sanctum','role:SuperAdmin'])->group(function () {
    //crear un admin
    Route::post('/create_admin', [SuperAdminController::class, 'createAdmin']);
});

Route::post('/noti_mark', function () {
    $users = User::all();
    // Iterar sobre cada usuario y marcar todas sus notificaciones como leídas
    $users->each(function ($user) {
        $user->unreadNotifications->markAsRead();
    });
    return response(['success'=>true]);
});
