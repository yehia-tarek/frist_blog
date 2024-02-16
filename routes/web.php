<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\CategoriesController;


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

Auth::routes();

/*
****************************************************************************
** Admin Routes
****************************************************************************
*/
Route::prefix('admin')->middleware('auth')->group(function () {

    // category route ----
    Route::resource('categories', CategoriesController::class);
    Route::get('/categories/restore/{id}', [CategoriesController::class, 'restore'])->name('categories.restore');
    Route::get('/categories/forceDelete/{id}', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');

    // news route ----
    Route::resource('news', NewsController::class);
});

/*
****************************************************************************
** Guest Routes
****************************************************************************
*/
Route::prefix('guest')->middleware('guest')->group(function(){
    // guest route ------
    Route::get('/{id}', [StaticController::class, 'guset'])->name('home.guset');
    Route::get('/single_news/{id}', [StaticController::class, 'single_news'])->name('guset.single_news');
});


Route::get('/', [StaticController::class, 'index'])->name('home.index');



Route::get('/logout', [StaticController::class, 'logout'])->name('home.logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
