<?php

use App\Models\Book;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MainCategoryController;


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

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/{page}', [AdminController::class,'index']);

// Route::get('/users',[UserController::class ,'index']);




Route::get('/create-role',[RoleController::class,'create'])->name('roles.create');
Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
Route::post('/store-roles', [RoleController::class, 'store'])->name('roles.store');
Route::delete('/destroy-roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::get('/update-role/{id}',[RoleController::class,'updatepage'])->name('roles.update');
Route::put('/role/{id}/updated',  [RoleController::class, 'update'])->name('role.updated');
//حاولت اعملن resourse بس ما مشي الحال  :(
// وما في وقت احاول :'(

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/registerpage', function () {
    return view('registerpage');
})->name('registerpage');


Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');


Route::get('/add_main_category', function () {
    return view('maincategory.addmaincategory');
})->name('add_main_category');

Route::get('/add_sub_category', function () {
    $mains = MainCategory::all();

    return view('subcategory.addsubcategory',compact('mains'));
})->name('add_sub_category');

Route::get('/add_book', function () {
    $subs = SubCategory::all();
    return view('books.addbooks',compact('subs'));
})->name('add_book');


Route::get('/MainCategory',[MainCategoryController::class,'index'])->name('MainCategory.index');
// Route::get('/SubCategory',[SubCategoryController::class,'index'])->name('SubCategory.index');


Route::post('/store-category-main', [MainCategoryController::class, 'store'])->name('store.category.main');
// Route::get('/all-category-main',[MainCategoryController::class,'index'])->name('category.index');

Route::post('/store-category-sub', [SubCategoryController::class, 'store'])->name('store.category.sub');
// Route::get('/all-category-sub',[SubCategoryController::class,'index'])->name('category.index.sub');


Route::post('/store-book', [BookController::class, 'store'])->name('store.book');
// Route::get('/all-book',[BookController::class,'index'])->name('book.index');



Route::get('/showBooks/maincategory/{id}', function ($id) {
    $subs_id=SubCategory::where('main_category_id',(int)$id)->get()->pluck('id');
    $books = Book::whereIn('sub_category_id',$subs_id)->get();
    return view('bookshow',compact('books'));
})->name('show.main');

Route::get('/showBooks/subcategory/{id}', function ($id) {
    $books = Book::where('sub_category_id',$id)->get();
    return view('bookshow',compact('books'));
})->name('show.sub');
// Route::get('/showBooks/{books}', function () {
//     // $books = Book::where('sub_category_id',$id)->get();
//     return view('bookshow',compact('books'));
// })->name('show');

// Route::get('/showBook', [BookController::class, 'index'])->name('show');


// Route::get('/show-all-Books', [BookController::class, 'index'])->name('showbookpage');
// Route::get('/show-all-Books',[BookController::class,'index'])->name('showbookpage.index');
// Route::post('/show-all-Books', function () {
//     $books = Book::all();
//     return view('bookshow',compact('books'));
// })->name('showbookpage');

// Route::get('/users-favorite',[UserController::class ,'show_user_favorite_book']);

// Route::get('/favorite/{book_id}',[UserController::class,'add_to_favorite'])->name('favorite');
// Route::get('/favorite/{book_id}',[UserController::class,'delete_from_favorite'])->name('delete.favorite');

Route::post('/favorite/{book_id}', [UserController::class, 'toggleFavorite'])->name('favorite');
Route::post('/store-rate/{book_id}', [UserController::class, 'store_rate'])->name('store.rate');

Route::delete('/Delete-main/{id}', [MainCategoryController::class, 'destroy'])->name('delete.main');
Route::delete('/Delete-sub/{id}', [SubCategoryController::class, 'destroy'])->name('delete.sub');
Route::delete('/Delete-book/{id}', [BookController::class, 'destroy'])->name('delete.book');