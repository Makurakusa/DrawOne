Route::get('/', [PictureController::class, 'index'])->name('index');
Route::get('/pictures', [PictureController::class, 'index']);
Route::get('/pictures/create', [PictureController::class, 'create'])->name('pictures.create');
Route::get('/themes/create', [ThemeController::class, 'create']);
Route::get('/pictures/{picture}/edit', [PictureController::class, 'edit']);
Route::get('/pictures/{picture}', [PictureController::class ,'show']);
Route::get('/themes/{theme}', [ThemeController::class ,'show']);
Route::put('/pictures/{picture}', [PictureController::class, 'update']);
Route::post('/themes', [ThemeController::class, 'store']);
Route::post('/pictures', [PictureController::class, 'store']);
Route::delete('/pictures/{picture}', [PictureController::class,'delete']);
// '/pictures/{対象データのID}'にGetリクエストが来たら、PictureControllerのshowメソッドを実行する
