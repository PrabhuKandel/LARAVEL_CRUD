<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;



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



Route::group(['middleware'=>'guest'],function(){
  Route::get('/',function(){

    return view('welcome');
  });

Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('register',[AuthController::class,'register_view'])->name('register');
Route::post('register',[AuthController::class,'register'])->name('register');
});
Route::group(['middleware'=>['auth','admin']],function()

{
  Route::get('admin/home', [AdminController::class,'index'])->name('products.adminIndex');
Route::delete('admin/products/{id}/delete', [AdminController::class,'destroy']);
Route::delete('admin/{id}/removeuser', [AdminController::class,'removeUser']);
Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
Route::get('admin/products/{id}/show',[ProductController::class,'show']);
});

Route::group(['middleware'=>['auth','user']],function(){
  Route::get('/home', [ProductController::class,'index'])->name('products.index');
  Route::get('user/logout',[AuthController::class,'logout'])->name('user.logout');
  Route::get('products/create', [ProductController::class,'create'])->name('products.create');
Route::post('products/store', [ProductController::class,'store'])->name('products.store');
Route::get('products/{id}/edit', [ProductController::class,'edit']);
Route::put('products/{id}/update', [ProductController::class,'update']);
Route::delete('products/{id}/delete', [ProductController::class,'destroy']);
Route::get('products/{id}/show',[ProductController::class,'show']);


});

