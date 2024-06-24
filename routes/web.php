<?php

use App\Http\Controllers\AdAccountController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\AgencyTransactionController;
use App\Http\Controllers\SettingController;

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
    return view('template.auth.page-login');
})->middleware(['guest']);

Route::get('/dashboard', function () {
    return view('template.home.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// notification start
Route::get('notifications/all', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('notification.index');
Route::get('notifications/{id}/all', [HomeController::class, 'indexClient'])->middleware(['auth', 'verified'])->name('notification.indexClient');
// notification end

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

Route::get('ad-account-application/new', [AdAccountController::class, 'create'])->middleware(['auth', 'verified'])->name('ad-account-application');
Route::get('ad-account-application/pending', [AdAccountController::class, 'showPendingAdAccounts'])->middleware(['auth', 'verified'])->name('pending-ad-account-application');
Route::get('ad-account-application/approved', [AdAccountController::class, 'showApprovedAdAccounts'])->middleware(['auth', 'verified'])->name('approved-ad-account-application');
Route::post('ad-account-application/new', [AdAccountController::class, 'store'])->middleware(['auth', 'verified'])->name('adaccount.store');
Route::get('ad-account-application/all', [AdAccountController::class, 'index'])->middleware(['auth', 'verified'])->name('ad-account.index');
Route::get('my-ad-account/all', [AdAccountController::class, 'account'])->middleware(['auth', 'verified'])->name('my-account.index');
Route::get('my-ad-account/{id}/details', [AdAccountController::class, 'myaccountshow'])->middleware(['auth', 'verified'])->name('my-account.show');
Route::get('ad-account-application/{id}/details', [AdAccountController::class, 'show'])->middleware(['auth', 'verified'])->name('ad-account.show');
Route::get('ad-account-application/{id}/edit', [AdAccountController::class, 'edit'])->middleware(['auth', 'verified'])->name('ad-account.edit');
Route::put('ad-account-application/{id}/edit', [AdAccountController::class, 'update'])->middleware(['auth', 'verified'])->name('ad-account.update');
Route::delete('ad-account-application/{id}/delete', [AdAccountController::class, 'destroy'])->middleware(['auth', 'verified'])->name('ad-account.destroy');
Route::put('ad-account-application/{id}/close', [AdAccountController::class, 'close'])->middleware(['auth', 'verified'])->name('ad-account.close');
Route::put('ad-account-application/{id}/active', [AdAccountController::class, 'active'])->middleware(['auth', 'verified'])->name('ad-account.active');
Route::patch('ad-account-application/{id}/status', [AdAccountController::class, 'updateStatus'])->middleware(['auth', 'verified'])->name('ad-account.updateStatus');

Route::get('/clients/{user}/ad-account', [AdAccountController::class, 'ad_account_id'])->middleware(['auth', 'verified'])->name('adaccount.adaccount');



Route::post('ad_account/{id}/transfer', [AdAccountController::class, 'transfer'])->middleware(['auth', 'verified'])->name('ad_account.transfer');


//ad account end


// refill related start

Route::get('ad-account/{client_id}/accounts', [RefillController::class, 'getClientAdAccounts'])->name('ad-account.client.accounts');
Route::get('ad-account/{id}/details', [RefillController::class, 'getAdAccountDetails'])->name('ad-account.details');
Route::get('refill-application', [RefillController::class, 'refill_application'])->middleware(['auth', 'verified'])->name('refill-application');

// new refill for customer
Route::get('refill-application/{id}/new', [RefillController::class, 'newRefill'])->middleware(['auth', 'verified'])->name('refills.newRefill');
// **************

Route::get('ad-accounts/{adAccount}/refill', [RefillController::class, 'refill_application_id'])->middleware(['auth', 'verified'])->name('refill.refill');
Route::post('refill', [RefillController::class, 'store'])->middleware(['auth', 'verified'])->name('refill.store');

Route::get('refills', [RefillController::class, 'index'])->middleware(['auth', 'verified'])->name('refills.index');
Route::get('pending-refills', [RefillController::class, 'pending'])->middleware(['auth', 'verified'])->name('refills.pending');
Route::get('refills/{id}', [RefillController::class, 'show'])->middleware(['auth', 'verified'])->name('refills.show');
Route::get('refills/{id}/edit', [RefillController::class, 'edit'])->middleware(['auth', 'verified'])->name('refills.edit');
Route::put('refills/{id}', [RefillController::class, 'update'])->middleware(['auth', 'verified'])->name('refills.update');
Route::delete('refills/{id}', [RefillController::class, 'destroy'])->middleware(['auth', 'verified'])->name('refills.destroy');
Route::patch('refills/{id}/status', [RefillController::class, 'updateStatus'])->name('refills.updateStatus');

Route::get('/refills/refills-name/update', [RefillController::class, 'update'])->middleware(['auth', 'verified']);
Route::post('refill/{id}/send-to-agency', [AgencyTransactionController::class, 'sendToAgency'])->middleware(['auth', 'verified'])->name('refill.sendToAgency');

// refill related end


//deposit

Route::get('deposits', [DepositController::class, 'index'])->middleware(['auth', 'verified'])->name('deposits.index');
Route::get('deposit/create', [DepositController::class, 'create'])->middleware(['auth', 'verified'])->name('deposit.create');
Route::post('deposit', [DepositController::class, 'store'])->middleware(['auth', 'verified'])->name('deposit.store');
Route::get('deposit/{id}', [DepositController::class, 'show'])->middleware(['auth', 'verified'])->name('deposit.show');
Route::get('deposit/{id}/edit', [DepositController::class, 'edit'])->middleware(['auth', 'verified'])->name('deposit.edit');
Route::put('deposit/{id}', [DepositController::class, 'update'])->middleware(['auth', 'verified'])->name('deposit.update');
Route::delete('deposit/{id}', [DepositController::class, 'destroy'])->middleware(['auth', 'verified'])->name('deposit.destroy');
Route::patch('deposit/{id}/status', [DepositController::class, 'updateStatus'])->middleware(['auth', 'verified'])->name('deposit.updateStatus');
Route::get('average-usd-rate', [DepositController::class, 'averageUsdRate'])->middleware(['auth', 'verified'])->name('averageUsdRate');


//deposit end


// settings start

Route::get('settings', [SettingController::class, 'show'])->middleware(['auth', 'verified'])->name('settings');
Route::post('settings/settingDollar', [SettingController::class, 'storeDollar'])->middleware(['auth', 'verified'])->name('setting.storeDollar');
Route::post('settings/settingPaymentMethod', [SettingController::class, 'storePaymentMethod'])->middleware(['auth', 'verified'])->name('setting.storePaymentMethod');
Route::post('settings/settingVendor', [SettingController::class, 'storeVendor'])->middleware(['auth', 'verified'])->name('setting.storeVendor');
Route::put('settings/updateDollar/{id}', [SettingController::class, 'updateDollar'])->middleware(['auth', 'verified'])->name('setting.updateDollar');
Route::delete('settings/destroyPaymentMethod/{id}', [SettingController::class, 'destroyPaymentMethod'])->middleware(['auth', 'verified'])->name('setting.destroyPaymentMethod');
Route::delete('settings/destroyVendor/{id}', [SettingController::class, 'destroyVendor'])->middleware(['auth', 'verified'])->name('setting.destroyVendor');


// settings end



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
