<?php

use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\SiginUpController;
use App\Http\Controllers\VerificaionController;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('HomeWeb');
})->where('any','.*')->name('home');
