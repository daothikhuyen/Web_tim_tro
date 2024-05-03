<?php

use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('HomeWeb');
})->where('any','.*');

Route::post('postManagement/index/upload-file', [UploadFileController::class, 'uploadFile']);
