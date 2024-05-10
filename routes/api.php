<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\LoginController;

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

//حاولت اعملن resourse بس ما مشي الحال  :(
// وما في وقت احاول
Route::get('/books',[BookController::class ,'index']);
Route::get('/book/{id}',[BookController::class ,'show']);
Route::post('/books',[BookController::class ,'store']);
Route::post('/books/{id}',[BookController::class ,'destroy']);
Route::post('/bookupdate/{id}',[BookController::class ,'update']);


Route::post('/login',[LoginController::class,'login']);

Route::post('/register',[LoginController::class,'register']);

Route::post('/logout', [LoginController::class, 'logout']);
// Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');


Route::post('/favorite/{id}', [UserController::class, 'toggleFavorite'])->middleware('auth:sanctum');

Route::post('/rate/{id}', [UserController::class, 'store_book_rate']) ->middleware('auth:sanctum');

Route::get('/books-In-Specific-MainCategory/{id}',[BookController::class, 'bookInSpecificMainCategory']);
Route::get('/books-In-Specific-SubCategory/{id}',[BookController::class, 'bookInSpecificSubCategory']);