<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [UserController::class, 'index']);
Route::get('login', [UserController::class, 'login']);
Route::post('login', [UserController::class, 'login_user']);
Route::get('register', [UserController::class, 'register']);
Route::post('register', [UserController::class, 'add_user'])->name('user.register');
Route::get('productDetail/{id}', [ProductController::class, 'productDetail']);

Route::group(['middleware'=>'user_auth'], function(){
    Route::get('cart', [CartController::class, 'index']);
    Route::get('cart/add/{id}/{change}', [CartController::class, 'manage_cart']);
    Route::get('cart/delete/{id}/', [CartController::class, 'delete_cart']);
    Route::get('checkout/{sum}', [CartController::class, 'checkout']);

    Route::get('order', [OrderController::class, 'index']);
    Route::get('order/delete/{id}', [OrderController::class, 'delete']);
    Route::get('order/{id}/{admin}', [OrderController::class, 'order_detail']);
    

    Route::post('order/place', [OrderController::class, 'place_order'])->name('order.place_order');

    Route::get('logout', function (){
        session()->forget('USER_LOGIN');
        session()->forget('USER_ID');
        session()->forget('USER_EMAIL');
        session()->forget('USER_NAME');
        session()->flash('error', 'Logged Out Successfully');
        return redirect('login');
    });


});


Route::get('admin', [AdminController::class, 'index']);
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
Route::get('admin/updatepassword', [AdminController::class, 'updatepassword']);

Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('admin/order/delete/{id}', [OrderController::class, 'delete']);
    Route::get('admin/order/{id}/{admin}', [OrderController::class, 'order_detail']);
    

    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/manage_category', [CategoryController::class, 'manage_category']);
    Route::get('admin/category/manage_category/{id}', [CategoryController::class, 'manage_category']);
    Route::post('admin/category/manage_category_process', [CategoryController::class, 'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);

    Route::get('admin/product', [ProductController::class, 'index']);
    Route::get('admin/product/manage_product', [ProductController::class, 'manage_product']);
    Route::get('admin/product/manage_product/{id}', [ProductController::class, 'manage_product']);
    Route::post('admin/product/manage_product_process', [ProductController::class, 'manage_product_process'])->name('product.manage_product_process');
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);

    

    Route::get('admin/logout', function (){
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error', 'Logged Out Successfully');
        return redirect('admin');
    });



});

