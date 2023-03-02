<?php

use App\Http\Controllers\api\v1\FileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserController::class)->group(function () {
    Route::post('/user', 'createUser');
});

Route::controller(FileController::class)->group(function () {
    Route::post('/upload', 'uploadFiles');
    Route::get('/{source}', 'getDocuments');
    Route::get('/{source}/{id}', 'getDocumentsByRefId');
});
