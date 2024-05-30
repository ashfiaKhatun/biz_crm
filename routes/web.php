<?php

use App\Http\Controllers\AdAccountController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefillController;
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








// agency related start
Route::get('add-agency', [AgencyController::class, 'add_agency'])->middleware(['auth', 'verified'])->name('add-agency');

Route::post('add-agency', [AgencyController::class, 'store'])->middleware(['auth', 'verified'])->name('agency.store');

Route::get('all-agency', [AgencyController::class, 'index'])->middleware(['auth', 'verified'])->name('all-agency');

Route::get('/agencies/{agency}/details', [AgencyController::class, 'details'])->middleware(['auth', 'verified'])->name('agency.details');

Route::get('/agencies/{agency}/update', [AgencyController::class, 'update'])->middleware(['auth', 'verified'])->name('agency.update');

Route::put('/agencies/{agency}/update', [AgencyController::class, 'storeUpdate'])->middleware(['auth', 'verified'])->name('agency.storeUpdate');

Route::delete('agencies/{id}', [AgencyController::class, 'destroy'])->name('agency.destroy');

// agency related end


//ad account start

Route::get('ad-account-application', [AdAccountController::class, 'create'])->middleware(['auth', 'verified'])->name('ad-account-application');
Route::post('ad-account-application', [AdAccountController::class, 'store'])->middleware(['auth', 'verified'])->name('adaccount.store');
Route::get('ad-account', [AdAccountController::class, 'index'])->middleware(['auth', 'verified'])->name('ad-account.index');
Route::get('ad-account/{id}', [AdAccountController::class, 'show'])->middleware(['auth', 'verified'])->name('ad-account.show');
Route::get('ad-account/{id}/edit', [AdAccountController::class, 'edit'])->middleware(['auth', 'verified'])->name('ad-account.edit');
Route::put('ad-account/{id}', [AdAccountController::class, 'update'])->middleware(['auth', 'verified'])->name('ad-account.update');
Route::delete('ad-account/{id}', [AdAccountController::class, 'destroy'])->middleware(['auth', 'verified'])->name('ad-account.destroy');
Route::patch('ad-account/{id}/status', [AdAccountController::class, 'updateStatus'])->middleware(['auth', 'verified'])->name('ad-account.updateStatus');

//ad account end


// refill related start

Route::get('ad-account/{client_id}/accounts', [RefillController::class, 'getClientAdAccounts'])->name('ad-account.client.accounts');
Route::get('ad-account/{id}/details', [RefillController::class, 'getAdAccountDetails'])->name('ad-account.details');
Route::get('refill-application', [RefillController::class, 'refill_application'])->middleware(['auth', 'verified'])->name('refill-application');
Route::post('refill', [RefillController::class, 'store'])->middleware(['auth', 'verified'])->name('refill.store');

Route::get('refills', [RefillController::class, 'index'])->middleware(['auth', 'verified'])->name('refills.index');
Route::get('refills/{id}', [RefillController::class, 'show'])->middleware(['auth', 'verified'])->name('refills.show');
Route::get('refills/{id}/edit', [RefillController::class, 'edit'])->middleware(['auth', 'verified'])->name('refills.edit');
Route::put('refills/{id}', [RefillController::class, 'update'])->middleware(['auth', 'verified'])->name('refills.update');
Route::delete('refills/{id}', [RefillController::class, 'destroy'])->middleware(['auth', 'verified'])->name('refills.destroy');
Route::patch('refills/{id}/status', [RefillController::class, 'updateStatus'])->name('refills.updateStatus');

Route::get('/refills/refills-name/update', [RefillController::class, 'update'])->middleware(['auth', 'verified']);

// refill related end



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
