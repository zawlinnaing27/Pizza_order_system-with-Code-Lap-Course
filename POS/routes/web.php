<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Models\Product;

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

//login,Register
Route::middleware(['Admin_auth'])->group(function(){
Route::redirect('/','loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('admin#loginPage');
Route::get('registerPage',[AuthController::class,'regiserPage'])->name('admin#registerPage');
});


Route::middleware(['auth'])->group(function () {
                             //admin
                           //dashboard
Route::get('dashboard',[AuthController::class,'dashboard'])->name('admin#dashboard');

 Route::group(['middleware'=>'Admin_auth'],function(){
                            //category
        Route::group(['prefix'=>'category'],function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('create#category');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
      });

            //   admin account
        Route::prefix('admin')->group(function(){
        Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');
            //profile
        Route::get('account/detail',[AdminController::class,'accountPage'])->name('admin#accountPage');
        Route::get('account/edit/page',[AdminController::class,'editaccountPage'])->name('admin#editAccountPage');
        Route::post('update/{id}',[AdminController::class,'update'])->name('admin#Update');
            //Admin List
        Route::get('list',[AdminController::class,'list'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            //Change Role
        Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
        Route::post('chabge/role/{id}',[AdminController::class,'change'])->name('admin#change');
           //Product
        Route::prefix('products')->group(function(){
        Route::get('list',[ProductController::class,'list'])->name('product#list');
        Route::get('detail/{id}',[ProductController::class,'detail'])->name('product.detail');
        Route::get('create/page',[ProductController::class,'createPage'])->name('product#createPage');
        Route::post('create',[ProductController::class,'create'])->name('product#create');
        Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
        Route::post('update/{id}',[ProductController::class,'update'])->name('product#update');
        Route::get('delete/{product}',[ProductController::class,'delete'])->name('product.delete');

        });


        });
    });






});

            //user account

        //home
        Route::group(['prefix'=> 'user','middleware'=>'User_auth'],function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        // profile
        Route::get('edit',[UserController::class,'edit'])->name('user#edit');
        Route::get('detail',[UserController::class,'detail'])->name('user#detail');
        Route::post('update/{id}',[UserController::class,'update'])->name('user#update');
        //Password
        Route::get('password/changePage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
        Route::post('changePassword',[UserController::class,'updatePassword'])->name('user#updatePassword');

        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            });

        });










// Route::get('/', function(){
//     return "hello";
// })->name('user.hello');
