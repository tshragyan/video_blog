<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\IsPostOwner;
use App\Http\Middleware\IsVideoOwner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', [Controller::class, 'home']);
    Route::redirect('/home', '/');
    Route::get('/user-posts', [PostController::class, 'getUserPosts'])->name('user.posts');
    Route::get('/user-videos', [VideoController::class, 'getUserVideos'])->name('user.videos');

    Route::prefix('/post')->group(function() {
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::middleware(IsPostOwner::class)->group(function() {
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
            Route::put('/{post}/update', [PostController::class, 'update'])->name('post.update');
        });
        Route::post('/', [PostController::class, 'store'])->name('post.store');
    });

    Route::prefix('/video')->group(function() {
        Route::get('/create', [VideoController::class, 'create'])->name('video.create');
        Route::middleware(IsVideoOwner::class)->group(function() {
            Route::get('/{video}/edit', [VideoController::class, 'edit'])->name('video.edit');
            Route::put('/{video}/update', [VideoController::class, 'update'])->name('video.update');
        });
        Route::post('/', [VideoController::class, 'store'])->name('video.store');
    });
});

Route::prefix('/post')->group(function() {
    Route::get('/{post}/add-comment', [PostController::class, 'createComment'])->name('post.create-comment');
    Route::post('/store-comment', [PostController::class, 'storeComment'])->name('post.store-comment');
    Route::get('/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('/', [PostController::class, 'index'])->name('post.index');
});

Route::prefix('/video')->group(function() {
    Route::get('/{video}/add-comment', [VideoController::class, 'createComment'])->name('video.create-comment');
    Route::post('/store-comment', [VideoController::class, 'storeComment'])->name('video.store-comment');
    Route::get('/{video}', [VideoController::class, 'show'])->name('video.show');
    Route::get('/', [VideoController::class, 'index'])->name('video.index');
});


