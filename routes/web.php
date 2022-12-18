<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', [ProductController::class , 'index'])->name('index');

Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');

Route::get('/login', [UserController::class,'login'])->name('login');
Route::post('/login', [UserController::class,'loginPost']);

Route::get('/register',[UserController::class, 'register'])->name('register');
Route::post('/register',[UserController::class, 'registerPost']);

Route::middleware('auth')->group(function (){

    Route::get('/logout', [UserController::class,'logout'])->name('logout');

    Route::middleware('Admin')->group(function (){
        Route::group(['prefix' => '/admin', 'as' => 'admin.'], function (){
            Route::resource('/products', ProductController::class);
        });
        Route::get('/completed/{order}', [OrderController::class, 'completed'])->name('completed');
        Route::get('/cancel/{order}', [OrderController::class, 'cancel'])->name('cancel');
        Route::get('/cooking/{order}', [OrderController::class, 'cooking'])->name('cooking');
    });

    Route::group(['prefix' => '/order', 'as' => 'order.'], function (){
        Route::get('/basket', [OrderController::class, 'basket'])->name('basket');
        Route::post('/basket', [OrderController::class, 'basketPost']);
        Route::get('/addBasket', [OrderController::class, 'addBasket'])->name('addBasket');
        Route::post('/createOrder', [OrderController::class, 'createOrder'])->name('createOrder');
        Route::get('/all/{myOrder?}', [OrderController::class, 'orders'])->name('all');
    });

});
