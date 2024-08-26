<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth','verified'])->group(function () {
    //dashboard
    Route::get('/dashboard', [PostController::class , 'home'])->name('dashboard');
    
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //post
    Route::resource('post',PostController::class);
    //comment
    Route::post('comment',[CommentController::class,'store'])->name('comment.store');
    Route::delete('comment/{id}',[CommentController::class,'destroy'])->name('comment.destroy');

});



require __DIR__.'/auth.php';
