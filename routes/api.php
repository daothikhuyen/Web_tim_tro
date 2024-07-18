<?php

use App\Http\Controllers\Feedbacks\FeedbackController;
use App\Http\Controllers\Feedbacks\FeedbackController_Admin;
use App\Http\Controllers\Feedbacks\Ratting_PostController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Posts\CreatePosts;
use App\Http\Controllers\Posts\CreatePosts_Admin;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\SiginUpController;
use App\Models\Ratting_Feedback;
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

Route::post('/upload-file', [UploadFileController::class, 'uploadFile']);
Route::post('/signup',[AuthController::class, 'signup']);
Route::post('/check/verifyOTP',[AuthController::class, 'is_activated']);
Route::post('/login',[AuthController::class, 'store'])->name("login");

Route::prefix('user')->group(function(){

    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/logout',[AuthController::class, 'logout']);
        Route::get('/getUser',[AuthController::class, 'getUser']);
        Route::DELETE('/destroy',[AuthController::class, 'delete_account']);
        Route::post('/update/{user}',[AuthController::class, 'update']);

        // admin
        Route::prefix('admin')->group(function(){
            Route::post('/list_user',[AuthController::class, 'list_user']);
            Route::post('/account_lock/{user}',[AuthController::class, 'account_lock']);
            Route::post('/destroyAccount/{user}',[AuthController::class, 'destroyAccount']);
            Route::post('/searchInput',[AuthController::class, 'searchInput']);
        });
    });

    Route::post('/reset_password/{token}',[AuthController::class, 'check_reset_password']);
    Route::post('/forgot_password',[AuthController::class, 'check_forgot_password']);
});

Route::prefix('posts')->group(function(){

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/getPost_ForMe',[CreatePosts::class,'getPost_ForMe']);
        Route::post('/create',[CreatePosts::class,'store']);
        Route::DELETE('/destroy',[CreatePosts::class,'destroy']);
        Route::get('/edit/{posts}',[CreatePosts::class,'show']);
        Route::post('/edit/{posts}',[CreatePosts::class,'update']);
        Route::post('/searchInput',[CreatePosts::class,'searchInput']);

        Route::prefix('admin')->group(function(){
            Route::post('/list_posts_user',[CreatePosts_Admin::class, 'list_posts_user']);
            Route::get('/detail/{posts}',[CreatePosts_Admin::class, 'show_detail']);
            Route::post('/destroy_posts/{posts}',[CreatePosts_Admin::class, 'destroy_posts']);
        });
    });


    Route::get('/getall',[CreatePosts::class,'index']);
    Route::post('/searchPriceOrArea',[CreatePosts::class,'getBySearch']);
    Route::post('/searchInput_All',[CreatePosts::class,'searchInput_All']);
    Route::post('/searchByLocation_Id',[CreatePosts::class,'searchByLocation_Id']);
});

Route::prefix('locations')->group(function(){
    Route::get('/getAll',[LocationController::class,'getLocation']);
    Route::post('/getNameLocation',[LocationController::class,'getNameLocation']);
    Route::post('/getLocationByParent_id',[LocationController::class,'getLocationByParent_id']);
});

Route::prefix('feedback')->group(function(){
    Route::post('/getFeedbacks/{posts}',[FeedbackController::class, 'index']);
    Route::post('/insert',[FeedbackController::class, 'store']);
    Route::prefix('admin')->group(function(){
        Route::post('/list_feedback/{posts}',[FeedbackController_Admin::class, 'getList_comment']);
        Route::post('/destroyFeedback/{feedback}',[FeedbackController_Admin::class, 'destroyFeedback']);
    });
});

Route::prefix('ratting')->group(function(){
    Route::get('/getLikePost',[Ratting_PostController::class,'index_Post']);
    Route::post('/likePost',[Ratting_PostController::class,'store_Post']);

    Route::post('/getlikeFeddback',[Ratting_PostController::class,'index_Feedback']);
    Route::post('/likeFeddback',[Ratting_PostController::class,'store_Feedback']);
});







