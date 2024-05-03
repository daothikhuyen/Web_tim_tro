<?php

use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('HomeWeb');
})->where('any','.*');

Route::post('/upload-file', [UploadFileController::class, 'uploadFile']);
