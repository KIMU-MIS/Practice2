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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/list', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');
Route::get('/regist',[App\Http\Controllers\ProductController::class, 'showRegistForm'])->name('regist');
Route::get('/productinfo',[App\Http\Controllers\ProductController::class, 'showProductInfo'])->name('productinfo');
Route::get('/newproduct',[App\Http\Controllers\ProductController::class, 'showEditForm'])->name('newproduct');
Route::get('/productdetail',[App\Http\Controllers\ProductController::class, 'showProductInfo2'])->name('productdetail');
Route::get('/infoediting',[App\Http\Controllers\ProductController::class, 'showEditForm2'])->name('infoediting');

Route::post('/regist',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('button');