<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'register']);
});

Route::middleware('auth:sanctum')->group(function () {

    //post
    Route::resource('post',PostController::class);
    Route::post('comment',[CommentController::class,'store'])->name('comment.store');
    Route::delete('comment/{id}',[CommentController::class,'destroy'])->name('comment.delete');

});

