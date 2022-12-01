<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\LlibreController;
use App\Http\Controllers\AutorController;


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

Route::get('/', [DefaultController::class, 'home'])->name('dashboard');

Route::get('/dashboard', [DefaultController::class, 'home'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//// LLIBRES

Route::get('/flights', function () {
    // Only authenticated users may access this route...
})->middleware('auth');

Route::get('/llibre/list', [LlibreController::class, 'list'])->name('llibre_list');
Route::match(['get', 'post'], '/llibre/new', [LlibreController::class, 'new'])->name('llibre_new')->middleware('auth');
Route::match(['get', 'post'], '/llibre/edit/{id}', [LlibreController::class, 'edit'])->name('llibre_edit')->middleware('auth');
Route::get('/llibre/delete/{id}', [LlibreController::class, 'delete'])->name('llibre_delete')->middleware('auth');

//// AUTORS

Route::get('/autor/list', [AutorController::class, 'list'])->name('autor_list');

Route::match(['get', 'post'], '/autor/new', [AutorController::class, 'new'])->name('autor_new')->middleware('auth');
Route::match(['get', 'post'], '/autor/edit/{id}', [AutorController::class, 'edit'])->name('autor_edit')->middleware('auth');
Route::get('/autor/delete/{id}', [AutorController::class, 'delete'])->name('autor_delete')->middleware('auth');

Route::get('/deletecookies', [DefaultController::class, 'deletecookies'])->name('deletecookies');

require __DIR__.'/auth.php';
