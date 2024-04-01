<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PictureController;  //外部にあるPictureControllerクラスをインポート。
use App\Http\Controllers\ThemeController;  //外部にあるThemeControllerクラスをインポート。

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

//Route::get('/', function () {
    //return view('welcome');
//});
Route::get('/', [PictureController::class, 'index'])->name('index');
Route::get('/pictures', [PictureController::class, 'index']);
Route::get('/pictures/create', [PictureController::class, 'create'])->name('pictures.create');
Route::get('/themes/create', [ThemeController::class, 'create']);
Route::get('/pictures/{picture}/edit', [PictureController::class, 'edit']);
Route::get('/pictures/{picture}', [PictureController::class ,'show']);
Route::put('/pictures/{picture}', [PictureController::class, 'update']);
Route::post('/themes', [ThemeController::class, 'store']);
Route::post('/pictures', [PictureController::class, 'store']);
Route::delete('/pictures/{picture}', [PictureController::class,'delete']);
// '/pictures/{対象データのID}'にGetリクエストが来たら、PictureControllerのshowメソッドを実行する
