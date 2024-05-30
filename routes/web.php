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

Route::get('ad-account-application', [AdAccountController::class, 'create'])->middleware(['auth', 'verified'])->name('ad-account-application');


// refill related start
Route::get('refill-application', [RefillController::class, 'refill_application'])->middleware(['auth', 'verified'])->name('refill-application');

Route::get('/refills/refills-name/update', [RefillController::class, 'update'])->middleware(['auth', 'verified']);

// refill related end



// agency related start
Route::get('add-agency', [AgencyController::class, 'add_agency'])->middleware(['auth', 'verified'])->name('add-agency');

Route::post('add-agency', [AgencyController::class, 'store'])->middleware(['auth', 'verified'])->name('agency.store');

Route::get('all-agency', [AgencyController::class, 'index'])->middleware(['auth', 'verified'])->name('all-agency');

Route::get('/agencies/{agency}/details', [AgencyController::class, 'details'])->middleware(['auth', 'verified'])->name('agency.details');

Route::get('/agencies/{agency}/update', [AgencyController::class, 'update'])->middleware(['auth', 'verified'])->name('agency.update');

Route::put('/agencies/{agency}/update', [AgencyController::class, 'storeUpdate'])->middleware(['auth', 'verified'])->name('agency.storeUpdate');

Route::delete('agencies/{id}', [AgencyController::class, 'destroy'])->name('agency.destroy');

// agency related end


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
