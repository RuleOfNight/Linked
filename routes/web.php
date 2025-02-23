<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

// Trang chủ
Route::get('/', [PostController::class, 'home'])->name('home');

// Nhóm route xác thực (Đăng nhập, Đăng ký, Đăng xuất)
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
    Route::resource('posts', PostController::class)->except(['show']);
});

// Xử lý tạo blog
Route::post('/blog', [ProfileController::class, 'createBlog'])->middleware('auth');
