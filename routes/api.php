<?php

use App\Http\Controllers\Feedbacks\FeedbackController;
use App\Http\Controllers\Feedbacks\Ratting_PostController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Posts\CreatePosts;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\SiginUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/signup',[AuthController::class, 'signup']);
Route::post('/check/verifyOTP',[AuthController::class, 'is_activated']);
Route::post('/login',[AuthController::class, 'store'])->name("login");

Route::prefix('get')->group(function(){
    Route::get('/getLocation',[LocationController::class,'getLocation']);
    Route::get('/getallPosts',[CreatePosts::class,'index']);

});

Route::prefix('feedback')->group(function(){
    Route::post('/getFeedbacks/{posts}',[FeedbackController::class, 'index']);
    Route::post('/insert',[FeedbackController::class, 'store']);

});

Route::prefix('ratting')->group(function(){
    Route::get('/getLikePost',[Ratting_PostController::class,'index_Post']);
    Route::post('/likePost',[Ratting_PostController::class,'store_Post']);

    Route::post('/getlikeFeddback',[Ratting_PostController::class,'index_Feedback']);
    Route::post('/likeFeddback',[Ratting_PostController::class,'store_Feedback']);
});

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/logout',[AuthController::class, 'logout']);
    Route::get('/getUser',[AuthController::class, 'getUser']);

    Route::prefix('posts')->group(function(){
        Route::post('/create',[CreatePosts::class,'store']);
    });

});

Route::post('/upload-file', [UploadFileController::class, 'uploadFile']);



