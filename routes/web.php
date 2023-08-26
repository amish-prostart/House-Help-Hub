<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
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
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout-user', [LoginController::class, 'logout'])->name('logout.user');
});

Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
        Route::get('/profile', [UserController::class, 'profileUpdate'])->name('profile.edit');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('change.password');

    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::resource('categories', CategoryController::class)->except('update');
        Route::post('categories/{category}/update',
            [CategoryController::class, 'update'])->name('categories.update');
        Route::post('categories/{category_id}/active-deactive',
            [CategoryController::class, 'activeDeActiveCategory'])->name('category.active-deactive');

        Route::post('users/{user}/status-active-deactive',
            [UserController::class, 'activeDeactiveUserStatus'])->name('users.active-deactive');
        Route::post('users/{user}/active-deactive',
            [UserController::class, 'activeDeactiveStatus'])->name('users.active-deactive-user');
        Route::post('users/{user}/email-verified',
            [UserController::class, 'isVerified'])->name('users.email-verified');

        Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');

        Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');

        Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});

// Front side routes
Route::get('/', [HomeController::class, 'home'])->name('front.home');
Route::get('services', [HomeController::class, 'services'])->name('front.services');
Route::get('services/{service}/{id}', [HomeController::class, 'servicesCategory'])->name('front.services-category');
Route::get('services-details/{service}/{id}', [HomeController::class, 'servicesDetail'])->name('front.services-detail');
Route::get('/profile-edit', [HomeController::class, 'frontUserProfile'])->name('front.user-profile');
Route::get('contact-us', [HomeController::class, 'contactUs'])->name('front.contact-us');


require __DIR__.'/auth.php';
