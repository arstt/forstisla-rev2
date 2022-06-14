<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\NormalizationController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\RankController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('welcome');

Route::middleware('auth', 'verified')->group(function () {
    //Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    Route::resource('nasabah', NasabahController::class);
    Route::resource('alternatives', AlternativeController::class);

    Route::get('decision', [DecisionController::class, 'index'])->name('decision');
    Route::get('normalization', [NormalizationController::class, 'index'])->name('normalization');
    Route::get('rank', [RankController::class, 'index'])->name('rank');

    Route::get('rank/{id}', [RankController::class, 'show'])->name('show.rank');
    Route::get('rank/{rendah_id}', [RankController::class, 'rendah'])->name('rendah.rank');
    Route::get('rank/{cukup_id}', [RankController::class, 'cukup'])->name('cukup.rank');
    Route::get('rank/{tinggi_id}', [RankController::class, 'tinggi'])->name('tinggi.rank');

    Route::get('billing', [BillingController::class, 'index'])->name('billing');
    Route::get('resume', [BillingController::class, 'resume'])->name('resume');
    Route::get('cancel', [BillingController::class, 'cancel'])->name('cancel');
    Route::get('invoices/download/{paymentId}', [BillingController::class,'downloadInvoice'])->name('invoices.download');

    Route::get('checkout/{plan_id}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    Route::resource('payment-method', PaymentMethodController::class);
    Route::get('payment-method/default/{paymentMethod}', [PaymentMethodController::class,'markDefault'])->name('payment-methods.markDefault');



});

Route::stripeWebhooks('webhook');
