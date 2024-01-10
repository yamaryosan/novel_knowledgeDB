<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PseudoPageController;
use App\Http\Controllers\WorkspaceModeController;
use App\Http\Controllers\HomeModeController;
use App\Http\Controllers\TempTriviaController;

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
Route::get('/index', [WorkspaceModeController::class, 'index'])->name('index');
Route::get('/session', [WorkspaceModeController::class, 'session'])->name('session');

// 自宅閲覧モード
Route::get('/home', [HomeModeController::class, 'index'])->name('home');
Route::post('/search', [HomeModeController::class, 'post'])->name('search');
Route::get('/search', [HomeModeController::class, 'result'])->name('result');
Route::post('/import', [HomeModeController::class, 'import'])->name('import');
Route::post('/export', [HomeModeController::class, 'export'])->name('export');
Route::get('/create', [HomeModeController::class, 'create'])->name('create');
Route::post('/store', [HomeModeController::class, 'store'])->name('store');
Route::get('/show/{id}', [HomeModeController::class, 'show'])->name('show');
Route::get('/edit/{id}', [HomeModeController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [HomeModeController::class, 'update'])->name('update');
Route::get('/delete/{id}', [HomeModeController::class, 'delete'])->name('delete');
Route::post('/preview/{id?}', [HomeModeController::class, 'preview'])->name('preview');
Route::post('/back', [HomeModeController::class, 'back'])->name('back');
Route::get('/all_delete', [HomeModeController::class, 'all_delete'])->name('all_delete');
Route::get('/temp', [TempTriviaController::class, 'index'])->name('temp');
Route::get('/temp/edit/{id}', [TempTriviaController::class, 'edit'])->name('temp_edit');
Route::post('/temp/store', [TempTriviaController::class, 'store'])->name('temp_store');
Route::post('/temp/update/{id}', [TempTriviaController::class, 'update'])->name('temp_update');
Route::get('/temp/delete/{id}', [TempTriviaController::class, 'delete'])->name('temp_delete');
Route::post('/temp/preview/{id}', [TempTriviaController::class, 'preview'])->name('temp_preview');
Route::post('/temp/migrate/{id}', [TempTriviaController::class, 'migrate'])->name('temp_migrate');
