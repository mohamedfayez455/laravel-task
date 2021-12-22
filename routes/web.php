<?php

use Illuminate\Support\Facades\Route;

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

// login
Route::group(['middleware' => 'IsGuest'],function(){
    Route::get('/login',[App\Http\Controllers\LoginController::class, 'getLogin'])->name('login');
    Route::post('/login',[App\Http\Controllers\LoginController::class, 'postLogin'])->name('login');
});

Route::group(['middleware' => 'auth'],function(){

    // logout
    Route::any('/logout',[App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');

    // home
    Route::get('/',[\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //posts
    Route::resource('/posts',App\Http\Controllers\PostsController::class);

});
