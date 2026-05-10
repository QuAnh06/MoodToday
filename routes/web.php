<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoveController;
use App\Http\Controllers\CrushDecoderController;


Route::get('/', [DashboardController::class, 'splash'])->name('splash');
Route::get('/home', [DashboardController::class, 'index'])->name('home');

Route::get('/profile', [DashboardController::class, 'show'])->name('profile');

Route::get('/diary', [DashboardController::class, 'history'])->name('diary');

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register'])->name('register.post');
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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

// Route::get('/crush-message', [CrushDecoderController::class, 'crushMessage'])->name('crush.message');
Route::prefix('crush-message')->name('crush.')->group(function () {
    Route::get('/', [CrushDecoderController::class, 'crushMessage'])->name('index');
    Route::post('/store', [CrushDecoderController::class, 'store'])->name('store');
    Route::get('/loading/{id}', [CrushDecoderController::class, 'loading'])->name('loading');
    Route::get('/result/{id}', [CrushDecoderController::class, 'result'])->name('result');
});

require __DIR__.'/admin.php';