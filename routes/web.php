<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Storefront
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/order', [OrderController::class, 'store'])->middleware('throttle:8,1')->name('order.store');
Route::get('/thank-you/{number}', [OrderController::class, 'thanks'])->name('order.thanks');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [Admin\AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.submit');

    Route::middleware('admin')->group(function () {
        Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/', Admin\DashboardController::class)->name('dashboard');

        Route::resource('products', Admin\ProductController::class)->except('show');
        Route::resource('banners', Admin\BannerController::class)->except('show');
        Route::resource('testimonials', Admin\TestimonialController::class)->except('show');

        Route::get('orders', [Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}', [Admin\OrderController::class, 'update'])->name('orders.update');
        Route::delete('orders/{order}', [Admin\OrderController::class, 'destroy'])->name('orders.destroy');

        Route::get('settings', [Admin\SettingController::class, 'general'])->name('settings.general');
        Route::post('settings', [Admin\SettingController::class, 'saveGeneral'])->name('settings.general.save');
        Route::get('pixels', [Admin\SettingController::class, 'pixels'])->name('settings.pixels');
        Route::post('pixels', [Admin\SettingController::class, 'savePixels'])->name('settings.pixels.save');
        Route::get('account', [Admin\SettingController::class, 'account'])->name('settings.account');
        Route::post('account', [Admin\SettingController::class, 'saveAccount'])->name('settings.account.save');
    });
});
