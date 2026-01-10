<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BanController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnbanController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/users/blogs/index');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
// Route::get('/blog',[App\Http\Controllers\BlogController::class,'index']);
// Route::get('/categories',[App\Http\Controllers\CategoryController::class,'index']);
// Route::get('/categories/create',[App\Http\Controllers\CategoryController::class,'create']);
// Route::post('/categories',[App\Http\Controllers\CategoryController::class,'store']);
// Route::get('/categories/{category}/edit',[App\Http\Controllers\CategoryController::class,'edit']);
// Route::patch('/categories/{category}/update',[App\Http\Controllers\CategoryController::class,'update']);
// Route::delete('/categories/{category}',[App\Http\Controllers\CategoryController::class,'delete']);

Route::resource('/categories',CategoryController::class)->middleware('can:admin');


Route::get('/tags',[App\Http\Controllers\TagController::class,'index'])->middleware('can:admin');

// Route::get('/blogs',[App\Http\Controllers\BlogController::class,'index']);
// Route::get('/blogs/create',[App\Http\Controllers\BlogController::class,'create']);
// Route::post('/blogs',[App\Http\Controllers\BlogController::class,'store']);

Route::resource('/blogs', BlogController::class)->middleware('can:admin');
Route::resource('/users', AdminUserController::class)->middleware('can:admin');

Route::get('/admin/bannedlist',[BanController::class,'index'])->middleware('can:admin');;
Route::get('/admin/users/{user}/banned',[BanController::class,'banned'])->middleware('can:admin');;

Route::put('/admin/users/{user}/unbanned',[UnbanController::class,'unban']);

Route::get('/admin/users',[AdminUserController::class,'index'])->middleware('can:admin')->middleware('can:admin');;
Route::get('/admin/users/{user}',[AdminUserController::class,'show'])->middleware('can:admin')->middleware('can:admin');;
Route::delete('/admin/users/{user}',[AdminUserController::class,'destroy'])->middleware('can:admin')->middleware('can:admin');;



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tags',[TagController::class,'index']);
Route::get('/tags/create',[TagController::class,'create']);
Route::post('/tags',[TagController::class,'store']);
Route::get('/tags/{tag}/edit',[TagController::class,'edit']);
Route::patch('/tags/{tag}/update',[TagController::class,'update']);
Route::delete('/tags/{tag}',[TagController::class,'destroy']);

Route::get('/users/blogs/index',[UserController::class,'index']);
Route::post('/users/blogs/index',[UserController::class,'searchCategory']);
Route::get('/users/blogs/index/{cid}',[UserController::class,'showByCategory']);
Route::get('/users/blogs/create',[UserController::class,'create']);
Route::post('/users/blogs',[UserController::class,'store']);
Route::get('/users/blogs/{blog}',[UserController::class,'show']);
Route::get('/users/blogs/{blog}/edit',[UserController::class,'edit']);
Route::patch('/users/blogs/{blog}/update',[UserController::class,'update']);
Route::delete('/users/blogs/{blog}',[UserController::class,'destroy']);

Route::get('/comments/create',[CommentController::class,'create']);
Route::post('/blogs/{blog}/comments',[CommentController::class,'store']);
Route::get('/comments/{comment}/edit',[CommentController::class,'edit']);
Route::patch('/comments/{comment}/update',[CommentController::class,'update']);
Route::delete('/comments/{comment}/',[CommentController::class,'destroy']);

Route::get('/users/profile/index',[ProfileController::class,'index']);
// Route::get('/users/blogs/{blog}',[UserController::class,'show']);
Route::get('/userprofile/{user}/edit',[PasswordController::class,'edit']);
Route::patch('/userprofile/{user}/update',[PasswordController::class,'update']);

Route::get('/userprofile/{user}/profileedit',[ProfileController::class,'edit']);
Route::patch('/userprofile/{user}/profileupdate',[ProfileController::class,'update']);


//Favourites
Route::post('/userblogs/{blog}/favourite',[FavouriteController::class,'store']);
Route::get('/favouritelist',[FavouriteController::class,'index']);
Route::delete('/userblogs/{blog}/unfavourite',[FavouriteController::class,'destroy']);

//likes
Route::post('/userblogs/{blog}/like',[LikeController::class,'store']);
Route::delete('/userblogs/{blog}/unlike',[LikeController::class,'destroy']);









