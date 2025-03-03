<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;


// Trang chủ
Route::get('/', [PostController::class, 'home'])->name('home');

// Nhóm route xác thực (Đăng nhập, Đăng ký)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Routes quản lý profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.uploadAvatar');
});

// Routes quản lý post
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
});

// Like post
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{id}/like', [LikeController::class, 'like'])->name('posts.like');

// Comment
Route::post('/posts/{id}/comments', [CommentController::class, 'store'])->name('posts.comments');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::post('/comments/{id}/pin', [CommentController::class, 'pin'])->name('comments.pin');

// Search
Route::get('profile/{id}', [ProfileController::class, 'show'])->name('profile');
Route::get('/search', [ProfileController::class, 'search'])->name('search');
