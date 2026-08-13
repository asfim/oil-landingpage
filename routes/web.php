<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/order', [HomeController::class, 'storeOrder'])->name('order.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::patch('orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('why-choose', \App\Http\Controllers\Admin\WhyChooseController::class);
        
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

        Route::resource('sales-popups', \App\Http\Controllers\Admin\SalesPopupController::class);

        Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');

        Route::get('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
        Route::patch('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        
        Route::post('clear-cache', [\App\Http\Controllers\Admin\SystemController::class, 'clearCache'])->name('clear-cache');
        Route::post('clear-logs', [\App\Http\Controllers\Admin\SystemController::class, 'clearLogs'])->name('clear-logs');
    });
});

Route::get('/copy-storage', function () {
    $source = storage_path('app/public');
    $destination = public_path('storage');
    
    try {
        \Illuminate\Support\Facades\File::copyDirectory($source, $destination);
        return 'All images successfully copied! Please check your website, images should show now.';
    } catch (\Exception $e) {
        return 'Error copying files: ' . $e->getMessage();
    }
});

Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'Cache cleared successfully.';
});
