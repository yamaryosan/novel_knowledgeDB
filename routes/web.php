<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PseudoPageController;
use App\Http\Controllers\TriviaController;

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

// 偽ページ
Route::get('/', [PseudoPageController::class, 'top'])->name('top');
Route::get('/recommend', [PseudoPageController::class, 'recommend'])->name('recommend');
Route::get('/new_article', [PseudoPageController::class, 'new_article'])->name('new_article');
Route::get('/category', [PseudoPageController::class, 'category'])->name('category');

// 秘密の呪文入力判定
Route::post('/secret', [PseudoPageController::class, 'post'])->name('secret');

// 職場閲覧モード
Route::get('/index', [TriviaController::class, 'index'])->name('index');

// 自宅閲覧モードランディングページ
Route::get('/s', [TriviaController::class, 'index'])->name('s');
