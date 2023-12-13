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

// ランディングページ
Route::get('/', [PseudoPageController::class, 'index']);
// 秘密の呪文入力判定
Route::post('/secret', [PseudoPageController::class, 'post'])->name('secret');

// ランディングページ
Route::get('/work', [TriviaController::class, 'index'])->name('index');
