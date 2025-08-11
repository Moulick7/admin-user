<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\CustomerRegistrationController;
use App\Http\Controllers\Auth\AdminRegistrationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\AdminLoginController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['auth']);
// CUSTOMER REGISTRATION
Route::get('/register/customer', [CustomerRegistrationController::class, 'create'])->name('register.customer');
Route::post('/register/customer', [CustomerRegistrationController::class, 'store'])->name('register.customer.store');

// ADMIN REGISTRATION
Route::get('/register/admin', [AdminRegistrationController::class, 'create'])->name('register.admin');
Route::post('/register/admin', [AdminRegistrationController::class, 'store'])->name('register.admin.store');

// EMAIL VERIFICATION (Code based)
Route::get('/verify-code', [EmailVerificationController::class, 'showForm'])->name('verify.code');
Route::post('/verify-code', [EmailVerificationController::class, 'verify'])->name('verification.code.verify');

// ADMIN LOGIN
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

// ADMIN DASHBOARD (Only verified admins)
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Welcome Admin!';
    })->name('admin.dashboard');
});

// Default Laravel auth routes (Breeze/Fortify/etc)
require __DIR__.'/auth.php';
