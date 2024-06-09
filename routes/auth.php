<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// Registration route for Customer
Route::get('clients', [UserController::class, 'indexClients'])->middleware(['auth', 'verified'])->name('user.client');
Route::get('register', [RegisteredUserController::class, 'createCustomer'])->middleware(['auth', 'verified'])->name('register');
Route::post('register', [RegisteredUserController::class, 'storeCustomer']);

// Registration route for Admins
Route::get('admins', [UserController::class, 'indexAdmins'])->middleware(['auth', 'verified'])->name('user.admin');
Route::get('register/admin', [RegisteredUserController::class, 'createAdmin'])->middleware(['auth', 'verified'])->name('register.admin');
Route::post('register/admin', [RegisteredUserController::class, 'storeAdmin']);
Route::get('admins/{id}/edit', [UserController::class, 'editAdmin'])->middleware(['auth', 'verified'])->name('admin.edit');
Route::put('admins/{id}', [UserController::class, 'updateAdmin'])->middleware(['auth', 'verified'])->name('admin.update');

// Registration route for Managers
Route::get('managers', [UserController::class, 'indexManagers'])->middleware(['auth', 'verified'])->name('user.manager');
Route::get('register/manager', [RegisteredUserController::class, 'createManager'])->middleware(['auth', 'verified'])->name('register.manager');
Route::post('register/manager', [RegisteredUserController::class, 'storeManager']);
Route::get('managers/{id}/edit', [UserController::class, 'editManager'])->middleware(['auth', 'verified'])->name('manager.edit');
Route::put('managers/{id}', [UserController::class, 'updateManager'])->middleware(['auth', 'verified'])->name('manager.update');