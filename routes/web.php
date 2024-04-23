<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PictureController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/pictures', 'store')->name('pictures.store');
    Route::get('/pictures/create', 'create')->name('pictures.create');
    Route::get('/pictures/search', 'search')->name('pictures.search');
    Route::get('/pictures/like', 'like')->name('pictures.like');
    Route::get('/pictures/unlike', 'unlike')->name('pictures.unlike');
    Route::get('/pictures/{picture}', 'show')->name('pictures.show');
    Route::put('/pictures/{picture}', 'update')->name('pictures.update');
    Route::delete('/pictures/{picture}', 'delete')->name('pictures.delete');
    Route::get('/pictures/{picture}/edit', 'edit')->name('pictures.edit');
});

Route::controller(ThemeController::class)->middleware(['auth'])->group(function(){
    Route::post('/themes', 'store')->name('store');
    Route::get('/themes/create', 'create')->name('create');
    Route::get('/themes/{theme}', 'show')->name('show');
});

Route::controller(CommentController::class)->middleware(['auth'])->group(function(){
    Route::post('/pictures/{picture}/{comment}', 'storeReply')->name('replies.store');
    Route::post('/pictures/{picture}', 'store')->name('comments.store');
    Route::delete('/pictures/{picture}/{comment}/{reply}', 'delete')->name('replies.delete');
    Route::delete('/pictures/{picture}/{comment}', 'destroy')->name('comments.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users/{user}', [UserController::class,'index'])->name('user.index');

require __DIR__.'/auth.php';
