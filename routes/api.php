<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\frontNewsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/',[NewsController::class,'index'])->middleware(['verify.shopify'])->name('home');
// Route::get('/index',[NewsController::class,'ajax_index'])->middleware(['verify.shopify']);

// Route::get('/create',[NewsController::class,'create'])->middleware(['verify.shopify']);
// Route::post('/store',[NewsController::class,'store'])->middleware(['verify.shopify']);

// Route::get('/edit/{news}',[NewsController::class,'edit'])->name('news.edit')->middleware(['verify.shopify']);

// Frontend News Route
Route::get('/frontNews',[frontNewsController::class,'index'])->name('frontNews.index');
Route::get('/showNews',[frontNewsController::class,'showNews'])->name('showNews.index');
// Route::get('/frontNews',[frontNewsController::class,''])->name('frontNews.index')->middleware(['verify.shopify']);
