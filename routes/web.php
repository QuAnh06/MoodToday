<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'splash'])->name('splash');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

Route::get('/profile', [DashboardController::class, 'show'])->name('profile');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
Route::get('/notifications', [DashboardController::class, 'notis'])->name('notifications');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('mood')->name('mood.')->group(function () {
    Route::get('/checkin-ai', [MoodController::class, 'checkinAi'])->name('checkin-ai');
    Route::post('/select', [MoodController::class, 'store'])->name('store');
    Route::get('/loading/{log_id}', [MoodController::class, 'loading'])->name('loading');
    Route::get('/result/{log_id}', [MoodController::class, 'result'])->name('result');
    Route::get('/history', [MoodController::class, 'history'])->name('history');
    Route::post('/ai-result', [MoodController::class, 'aiResult'])->name('ai-result');
});

require __DIR__.'/admin.php';