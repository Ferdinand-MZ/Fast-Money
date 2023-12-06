<?php

use App\Http\Controllers\CreditBillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

*/

use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\InternetBillController;
use App\Http\Controllers\ElectricbillController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UsersController;


Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');

// PDF
Route::get('internetbill/pdf/{id}', [PDFController::class, 'pdfInternetBill'])->name('pdf.internetBill');
Route::get('internetbill/pdf', [PDFController::class, 'pdfAllInternetBill'])->name('pdf.allInternetBill');
Route::get('electricbill/pdf/{id}', [PDFController::class, 'pdfElectricBill'])->name('pdf.electricBill');
Route::get('electricbill/pdf', [PDFController::class, 'pdfAllElectricBill'])->name('pdf.allElectricBill');
Route::get('creditbill/pdf/{id}', [PDFController::class, 'pdfCreditBill'])->name('pdf.creditBill');
Route::get('creditbill/pdf', [PDFController::class, 'pdfAllCreditBill'])->name('pdf.allCreditBill');
Route::get('users/pdf', [PDFController::class, 'pdfAllUsers'])->name('pdf.allUsers');

// Users
Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
Route::delete('/users/destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');

// ElectricBill
Route::put('/electricBill/{id}', [ElectricbillController::class, 'update'])->name('electricBill.update');
Route::patch('/electricBill/{id}', [ElectricBillController::class, 'update'])->name('electric-bill.update');
Route::delete('/electricBill/destroy/{id}', [ElectricbillController::class, 'destroy'])->name('electricBill.destroy');
Route::post('/electricBill/store', [ElectricbillController::class, 'storeElectricBill'])->name('electricBill.store');
Route::get('/electricBill', [ElectricbillController::class, 'showElectricBillsView'])->name('electricBill');
Route::post('/store-electric-bill', [ElectricBillController::class, 'storeElectricBillForUser'])->name('electricBill.storeForUser');
Route::post('/storeElectricBill', [ElectricbillController::class, 'storeElectricBill'])->name('storeElectricBill');
Route::get('/electricBill/{id}/edit', [ElectricbillController::class, 'edit'])->name('electricBill.edit');
// Route::post('/store-electric-bill', [ElectricBillController::class, 'storeElectricBill'])->name('electricBill.store');
// Route::get('/electricBill', [ElectricbillController::class, 'showElectricBillsView'])->name('electricBill');

// InternetBill
Route::get('/internetBill', [InternetBillController::class, 'showInternetBillsView'])->name('internetBill');
Route::post('/internetBill/store', [InternetBillController::class, 'storeInternetBill'])->name('internetBill.store');
Route::post('/store-internet-bill', [InternetBillController::class, 'storeInternetBillForUser'])->name('internetBill.storeForUser');
Route::delete('/internetBill/destroy/{id}', [InternetBillController::class, 'destroy'])->name('internetBill.destroy');
Route::get('/internetBill/{id}/edit', [InternetBillController::class, 'edit'])->name('internetBill.edit');
Route::put('/internetBill/{id}', [InternetBillController::class, 'update'])->name('internetBill.update');

// CreditBill
Route::get('/creditBill', [CreditBillController::class, 'showCreditBillsView'])->name('creditBill');
Route::post('/creditBill/store', [CreditBillController::class, 'storeCreditBill'])->name('creditBill.store');
Route::post('/store-credit-bill', [CreditBillController::class, 'storeCreditBillForUser'])->name('creditBill.storeForUser');
Route::delete('/creditBill/destroy/{id}', [CreditBillController::class, 'destroy'])->name('creditBill.destroy');
Route::put('/creditBill/{id}', [CreditBillController::class, 'update'])->name('creditBill.update');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/kirim', [SaldoController::class, 'kirim'])->name('kirim');
Route::get('/isi', [SaldoController::class, 'isi'])->name('isi');
Route::get('/admin-saldo', [SaldoController::class, 'admin_saldo'])->name('admin-saldo');
Route::get('/transaksi', [SaldoController::class, 'transaksi'])->name('transaksi');
Route::get('/token-listrik', [SaldoController::class, 'tokenlistrik'])->name('token-listrik');
Route::get('/bayar-internet', [SaldoController::class, 'bayarinternet'])->name('bayar-internet');
Route::get('/beli-pulsa', [SaldoController::class, 'belipulsa'])->name('beli-pulsa');
Route::get('/log', [SaldoController::class, 'log'])->name('log');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::post('/profile/update/picture', [UserProfileController::class, 'updateProfilePicture'])->name('profile.update.picture');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile/delete', [UserProfileController::class,'destroy'])->name('profile.destroy');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('delete_user');


// transaksi
Route::post('/wallet/submit', [WalletController::class, 'submit'])->name('wallet.submit');



Route::post('/store-bayar-internet', [InternetBillController::class, 'storeInternetBill'])->name('storeInternetBill');

Route::post('/store-beli-pulsa', [CreditBillController::class, 'storeCreditBill'])->name('storeCreditBill');

// Route::get('auth/github', [GithubController::class, 'redirect'])->name('github.login');
// Route::get('auth/github/callback', [GithubController::class, 'callback']);
