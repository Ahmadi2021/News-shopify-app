<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\frontNewsController;

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

// Route::get('/', function () {
//     return view('welcome')->middleware(['varify.shopify']);
// });
Route::get('/',[NewsController::class,'index'])->middleware(['verify.shopify'])->name('home');
Route::get('/news/{news}',[NewsController::class,'show'])->name('news.show')->middleware(['verify.shopify']);
Route::get('/ajaxIndex',[NewsController::class,'ajaxIndex'])->name('ajax_index')->middleware(['verify.shopify']);

Route::get('/pagination',[NewsController::class,'pagination'])->name('pagination')->middleware(['verify.shopify']);


Route::get('/create',[NewsController::class,'create'])->middleware(['verify.shopify']);
Route::post('/store',[NewsController::class,'store'])->middleware(['verify.shopify']);

Route::get('/news/{news}/edit',[NewsController::class,'edit'])->name('news.edit')->middleware(['verify.shopify']);
Route::post('/news/{news}',[NewsController::class,'update'])->name('news.update')->middleware(['verify.shopify']);

Route::delete('/news/{news}',[NewsController::class,'destroy'])->name('news.destroy')->middleware(['verify.shopify']);

// // Frontend News Route
// Route::get('/frontNews',[frontNewsController::class,'index'])->name('frontNews.index')->middleware(['verify.shopify']);

Route::get('/showApi',[NewsController::class,'showApi'])->middleware(['verify.shopify']);
