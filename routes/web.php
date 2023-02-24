<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Middleware\CustomAuth;


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
    return view('home');
});
Route::get('/login', [UserAuth::class, 'loginPage'])->name('login');
Route::get('/signup', [UserAuth::class,'signupPage'])->name('signup');
Route::post('/signupuser', [UserAuth::class,'signup']);
Route::post('/loginuser', [UserAuth::class,'login']);
Route::group(['middleware'=>"auth"],function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::get('logout', [UserAuth::class, 'logout']);
});
Route::get('/verify-email-page',function(){
return view('verify-email-page');
});

Route::post('/verify-email', [UserAuth::class,'verifyEmail']);



