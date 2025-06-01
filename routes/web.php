<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; 

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
    return view('welcome');
});

Auth::routes();

Route::get('/list', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');
Route::get('/regist',[App\Http\Controllers\ProductController::class, 'showRegistForm'])->name('regist');
Route::get('/productinfo',[App\Http\Controllers\ProductController::class, 'showProductInfo'])->name('productinfo');
Route::get('/productinfo', [ProductController::class, 'index'])->name('product.index');
Route::get('/newproduct',[App\Http\Controllers\ProductController::class, 'showEditForm'])->name('newproduct');
Route::get('/productdetail',[App\Http\Controllers\ProductController::class, 'showProductListDetail'])->name('productdetail');
Route::get('/infoediting/{id}',[App\Http\Controllers\ProductController::class, 'showEditForm2'])->name('infoediting');

Route::post('/regist',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('button');
Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');

Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/products/{id}', [ProductController::class, 'showDetail'])->name('product.show');