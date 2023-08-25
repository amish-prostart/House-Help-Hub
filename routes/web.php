<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('categories', CategoryController::class)->except('update');
Route::post('categories/{category}/update',
    [CategoryController::class, 'update'])->name('categories.update');
Route::post('categories/{category_id}/active-deactive',
    [CategoryController::class, 'activeDeActiveCategory'])->name('category.active-deactive');

Route::resource('users', UserController::class);
Route::post('users/{user}/status-active-deactive',
    [UserController::class, 'activeDeactiveUserStatus'])->name('users.active-deactive');
Route::post('users/{user}/active-deactive',
    [UserController::class, 'activeDeactiveStatus'])->name('users.active-deactive-user');
Route::post('users/{user}/email-verified',
    [UserController::class, 'isVerified'])->name('users.email-verified');

Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');

Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

// Front side routes
Route::get('/', [HomeController::class, 'home'])->name('front.home');
Route::get('services', [HomeController::class, 'services'])->name('front.services');
Route::get('services/{service}/{id}', [HomeController::class, 'servicesCategory'])->name('front.services-category');
Route::get('services-details/{service}/{id}', [HomeController::class, 'servicesDetail'])->name('front.services-detail');

require __DIR__.'/auth.php';
