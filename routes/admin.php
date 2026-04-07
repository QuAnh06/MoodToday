<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthAdmin;

Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
// Admin authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin routes (protected by AuthAdmin middleware)
Route::middleware([\App\Http\Middleware\AuthAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/moods', [AdminController::class, 'moods'])->name('moods.index');
    Route::get('/prompts', [AdminController::class, 'prompts'])->name('prompts.index');
});