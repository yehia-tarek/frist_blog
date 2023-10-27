<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NewsController;


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

Route::get('/', [StaticController::class, 'index'])->name('home.index');
Route::get('/logout', [StaticController::class, 'logout'])->name('home.logout');

// guest route ------
Route::get('/guset/guset/{id}', [StaticController::class, 'guset'])->name('home.guset');
Route::get('/guset/single_news/{id}', [StaticController::class, 'single_news'])->name('guset.single_news');

// category route ----
Route::resource('categories', CategoriesController::class);
Route::get('/categories/restore/{id}', [CategoriesController::class, 'restore'])->name('categories.restore');
Route::get('/categories/forceDelete/{id}', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');
// category route ----



Route::resource('news', NewsController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


