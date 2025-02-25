<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Trang chủ
Route::get('/', [PostController::class, 'home'])->name('home');

// Nhóm route xác thực (Đăng nhập, Đăng ký)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Routes quản lý Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.uploadAvatar');
});

// Routes quản lý bài viết
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
});


use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

Route::post('/posts/{id}/like', [LikeController::class, 'like'])->name('posts.like');
Route::post('/posts/{id}/comment', [CommentController::class, 'comment'])->name('posts.comment');

Route::get('profile/{name}',[ProfileController::class, 'show'])->name('profile');
Route::get('/search', [ProfileController::class, 'search'])->name('search');




// // Gửi email đặt lại mật khẩu
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// // Hiển thị form đặt lại mật khẩu
// Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// // Xử lý đặt lại mật khẩu
// Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


