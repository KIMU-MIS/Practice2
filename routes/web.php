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


// 商品一覧画面
Route::get('/productinfo', [ProductController::class, 'index'])->name('product.index');
// 商品新規登録画面
Route::get('/products/create', [ProductController::class, 'showForm'])->name('product.create');
// 商品情報一覧画面
Route::get('/productdetail',[App\Http\Controllers\ProductController::class, 'showProductListDetail'])->name('productdetail');
// 商品情報編集画面
Route::get('/products/{id}/edit', [ProductController::class, 'showForm'])->name('product.edit');
// 商品情報登録処理
Route::post('/regist',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('button');
// 商品情報削除処理（DELETE）
Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
// 商品情報更新処理
Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
// 商品情報詳細画面
Route::get('/products/{id}', [ProductController::class, 'showDetail'])->name('product.show');


