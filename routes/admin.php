<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;


Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () { //
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');

    // Quản lý Moods
    Route::get('/moods', [AdminController::class, 'moods'])->name('moods.index'); 
    Route::get('/moods/create', [AdminController::class, 'createMood'])->name('moods.create'); // Form thêm mới
    Route::post('/moods', [AdminController::class, 'storeMood'])->name('moods.store'); // Lưu mood mới
    Route::get('/moods/{mood}/edit', [AdminController::class, 'editMood'])->name('moods.edit'); // Form sửa
    Route::put('/moods/{mood}', [AdminController::class, 'updateMood'])->name('moods.update'); // Cập nhật mood
    Route::post('/moods/{mood}/toggle', [AdminController::class, 'toggleMood'])->name('moods.toggle'); // Bật/Tắt

    // Quản lý AI Prompts
    Route::get('/prompts', [AdminController::class, 'prompts'])->name('prompts.index');
    Route::get('/prompts/create', [AdminController::class, 'createPrompt'])->name('prompts.create');
    Route::post('/prompts', [AdminController::class, 'storePrompt'])->name('prompts.store');
    Route::get('/prompts/{prompt}', [AdminController::class, 'showPrompt'])->name('prompts.show');
    Route::get('/prompts/{prompt}/edit', [AdminController::class, 'editPrompt'])->name('prompts.edit');
    Route::put('/prompts/{prompt}', [AdminController::class, 'updatePrompt'])->name('prompts.update');
    Route::delete('/prompts/{prompt}', [AdminController::class, 'destroyPrompt'])->name('prompts.destroy');
});