<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Review;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//funcion de inicio que me dio pereza cambiar

Route::get('/', [UserController::class,'welcome'])->name('inicio');
//funciones basicas para usuarios
Route::get('/register', [UserController::class,'index_register'])->name('view_register');
Route::post('/register', [UserController::class,'register'])->name('register');

Route::get('/login', [UserController::class,'index_login'])->name('view_login');
Route::post('/login', [UserController::class,'login'])->name('login');
Route::get('/logout', [UserController::class,'logout'])->name('logout');

//login-logout de admin
Route::get('/login_admin', [AdminController::class,'login_admin_view'])->name('login_admin_view');
Route::post('/login_admin', [AdminController::class,'login_admin'])->name('admin_login');

//rutas protegidas para admin
Route::middleware('auth:admin')->group(function () {
    // Rutas protegidas para el administrador
    Route::get('/inicio_admin', [AdminController::class,'index_admin'])->name('index_admin');
    Route::get('/logout_admin',[AdminController::class,'logout'])->name('logout_admin');
    //solo un administrador puede crear otro
    // Route::get('/created_admin',[AdminController::class, 'create_admin'])->name('create_admin');
    //admin Reviews
    Route::get('/table_reviews',[ReviewController::class,'show_table'])->name('table_reviews');
    Route::get('/create_review/{review?}', [ReviewController::class, 'create_review'])->name('create_review_view');
    Route::post('/crear_review',[ReviewController::class,'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.delete');

});
Route::get('/created_admin',[AdminController::class, 'create_admin'])->name('create_admin');

//Ruta para ver la reseña como usuario
Route::get('ver/{slug}', [ReviewController::class,'show'])->name('show.review');
//Ruta de buscar
Route::get('/buscar',[UserController::class,'search'])->name('reviews.search');

//rutas protegidas para usuario
Route::middleware(['auth','verified'])->group(function () {
    //rutas de comentarios
    Route::post('/new_comment', [ComentarioController::class,'store'])->name('new.comment');
    Route::post('/ver/{slug}/calificar_review',[ReviewController::class,'calificar_review'])->name('grade.review');

});

Route::get('verificar-email/{id}/{hash}', [UserController::class,'verify'])->middleware('auth')->name('verification.verify');
