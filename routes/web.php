<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoveController;

Route::get('/', [DashboardController::class, 'splash'])->name('splash');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

Route::get('/profile', [DashboardController::class, 'show'])->name('profile');

Route::get('/diary', [DashboardController::class, 'history'])->name('diary');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('mood')->name('mood.')->group(function () {
    Route::post('/store', [MoodController::class, 'store'])->name('store');
    Route::get('/loading/{log_id}', [MoodController::class, 'loading'])->name('loading');
    Route::get('/result/{log_id}', [MoodController::class, 'result'])->name('result');
    
});

Route::prefix('love-percent')->group(function () {
    Route::get('/love-percent', [LoveController::class, 'lovePercent'])->name('love.percent');
    Route::post('/store', [LoveController::class, 'store'])->name('store');
    Route::get('/loading/{log_id}', [LoveController::class, 'loading'])->name('loading');
    Route::get('/result/{log_id}', [LoveController::class, 'result'])->name('result');
    
});

Route::get('/crush-message', [LoveController::class, 'crushMessage'])->name('crush.message');

require __DIR__.'/admin.php';