<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('template.home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('ad-account-application', [HomeController::class, 'ad_account_application'])->middleware(['auth', 'verified'])->name('ad-account-application');

Route::get('refill-application', [HomeController::class, 'refill_application'])->middleware(['auth', 'verified'])->name('refill-application');

Route::get('add-agency', [HomeController::class, 'add_agency'])->middleware(['auth', 'verified'])->name('add-agency');

Route::post('add-agency', [AgencyController::class, 'store'])->middleware(['auth', 'verified'])->name('agency.store');

Route::get('all-agency', [AgencyController::class, 'index'])->middleware(['auth', 'verified'])->name('all-agency');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
