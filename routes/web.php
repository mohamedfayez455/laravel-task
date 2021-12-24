<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//language prefix route
Route::group([ 'prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    // middleware for check that user not login before go to login page
    Route::group(['middleware' => 'IsGuest'],function(){
        // login with Email & password
        Route::get('/login', [\App\Http\Controllers\Authentication\LoginController::class, 'getLogin'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Authentication\LoginController::class, 'postLogin'])->name('login');
        // login with Google
        Route::get('/auth-redirect', ['App\Http\Controllers\Authentication\GoogleAuthController', 'redirect'])->name('google.auth-redirect');
        Route::get('/auth-callback', ['App\Http\Controllers\Authentication\GoogleAuthController', 'callback']);
    });
    // routes for login user
    Route::group(['middleware' => 'auth'],function(){
        // logout
        Route::any('/logout', [\App\Http\Controllers\Authentication\LogoutController::class, 'logout'])->name('logout');
        // home
        Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
        //posts
        Route::resource('/posts',App\Http\Controllers\PostsController::class);
    });
});
