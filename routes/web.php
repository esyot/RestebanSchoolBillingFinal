<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChargesController;
use App\Http\Controllers\ModalController;

use App\Http\Controllers\StripePaymentController;

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



Route::get('/', [SiteController::class, 'index']);

Route::get('/dashboard', [SiteController::class, 'index'])->name('dashboard');

//students
Route::get('/students/view', [StudentController::class, 'index'])->name('students.view');

Route::get('/student/view/{id}',[StudentController::class, 'student'])->name('student.view');

//accounts
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts');
Route::get('/accounts/view', [AccountController::class, 'view'])->name('accounts.view');
Route::get('/account/{id}', [AccountController::class, 'single'])->name('account.view');
Route::get('/account/create', [AccountController::class, 'create'])->name('account.create');
Route::get('/account/edit/{id}', [AccountController::class, 'edit']);


//charges
Route::get('charge/{id}', [ChargesController::class, 'chargeEditModal']);

Route::get('/charges/view', [ChargesController::class, 'index']);
Route::get('/charges/view/{id}', [ChargesController::class, 'charges'])->name('charges.view');

Route::get('/accounts/{id}/charges', [AccountController::class, 'getCharges'])->name('accounts.charges');

Route::get('/charge/modal/{id}', [ChargesController::class, 'chargeModal'])->name('charge.modal');

//payment
Route::get('/account/pay/{id}/{remarks}', [AccountController::class, 'pay'])->name('account.pay');


//modals
Route::get('/account/edit/modal/{id}', [ModalController::class, 'accountEditModal']);


//stripes
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe/{id}', 'stripePost')->name('stripe.post');
});

Route::get('/cardpayment/{id}', function($id){
        return view('pages.cardpayment',['id'=>$id]);
})->name('cardpayment');