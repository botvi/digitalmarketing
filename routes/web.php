<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController,
    KategoriController,
    SubKategoriController,
    ProdukController,
    GeoIPController,
    DepositController,
    PaymentController,
    DaftarSaldoController,
    WebsiteController,
    RegisterController,
    LoginController,
    DepositUsdController,
    DepositIdrController,
    HistoryController,
    OrderProdukController,
    SettingController,
    AdminOrderController,
    FilteringController,
    ForgotPasswordController
    
};
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

// Route::get('/', function () {
//     return view('welcome');
// });
// REG
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Menangani proses logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [WebsiteController::class, 'index'])->name('website.index');


route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->middleware('role:admin');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "kategori"
], function ($router) {
    Route::get('/', [KategoriController::class, 'index'])->name('categories.index')->middleware('role:admin');
    Route::get('/create', [KategoriController::class, 'create'])->name('categories.create')->middleware('role:admin');
    Route::post('/', [KategoriController::class, 'store'])->name('categories.store')->middleware('role:admin');
    Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('categories.edit')->middleware('role:admin');
    Route::put('/{id}', [KategoriController::class, 'update'])->name('categories.update')->middleware('role:admin');
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('categories.destroy')->middleware('role:admin');
});

Route::group([
    'middleware' => ["auth"],
    'prefix' => "subkategori"
], function ($router) {
    Route::get('/', [SubKategoriController::class, 'index'])->name('subkategori.index')->middleware('role:admin');
    Route::get('/create', [SubKategoriController::class, 'create'])->name('subkategori.create')->middleware('role:admin');
    Route::post('/', [SubKategoriController::class, 'store'])->name('subkategori.store')->middleware('role:admin');
    Route::get('/{id}/edit', [SubKategoriController::class, 'edit'])->name('subkategori.edit')->middleware('role:admin');
    Route::put('/{id}', [SubKategoriController::class, 'update'])->name('subkategori.update')->middleware('role:admin');
    Route::delete('/{id}', [SubKategoriController::class, 'destroy'])->name('subkategori.destroy')->middleware('role:admin');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "produk"
], function ($router) {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index')->middleware('role:admin');
    Route::get('/create', [ProdukController::class, 'create'])->name('produk.create')->middleware('role:admin');
    Route::post('/', [ProdukController::class, 'store'])->name('produk.store')->middleware('role:admin');
    Route::get('/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit')->middleware('role:admin');
    Route::put('/{id}', [ProdukController::class, 'update'])->name('produk.update')->middleware('role:admin');
    Route::delete('//{id}', [ProdukController::class, 'destroy'])->name('produk.destroy')->middleware('role:admin');
    Route::get('/get-sub-kategoris/{kategori_id}', [ProdukController::class, 'getSubKategoris'])->middleware('role:admin');
    Route::get('/{id}/download', [ProdukController::class, 'download'])->name('produk.download')->middleware('role:admin');
});


Route::group([
    'middleware' => ["auth"],
    'prefix' => "daftarsaldo"
], function ($router) {
    Route::get('/', [DaftarSaldoController::class, 'index'])->name('daftarsaldo.index')->middleware('role:admin');
    Route::get('/create', [DaftarSaldoController::class, 'create'])->name('daftarsaldo.create')->middleware('role:admin');
    Route::post('/', [DaftarSaldoController::class, 'store'])->name('daftarsaldo.store')->middleware('role:admin');
    Route::get('/{id}/edit', [DaftarSaldoController::class, 'edit'])->name('daftarsaldo.edit')->middleware('role:admin');
    Route::put('/{id}', [DaftarSaldoController::class, 'update'])->name('daftarsaldo.update')->middleware('role:admin');
    Route::delete('/{id}', [DaftarSaldoController::class, 'destroy'])->name('daftarsaldo.destroy')->middleware('role:admin');

});

Route::group([
    'middleware' => ["auth"],
    'prefix' => "riwayatdeposit"
], function ($router) {
    Route::get('/', [DaftarSaldoController::class, 'riwayatdeposit'])->name('riwayatdeposit')->middleware('role:admin');  
});

Route::group([
    'middleware' => ["auth"],
    'prefix' => "riwayatorder"
], function ($router) {
    Route::get('/', [AdminOrderController::class, 'adminorder'])->middleware('role:admin');  
});

Route::group([
    'middleware' => ["auth"],
    'prefix' => "setting"
], function ($router) {
    Route::get('/', [SettingController::class, 'index'])->name('setting.index')->middleware('role:admin');
    Route::get('/create', [SettingController::class, 'create'])->name('setting.create')->middleware('role:admin');
    Route::post('/', [SettingController::class, 'store'])->name('setting.store')->middleware('role:admin');
    Route::get('/{id}/edit', [SettingController::class, 'edit'])->name('setting.edit')->middleware('role:admin');
    Route::put('/{id}', [SettingController::class, 'update'])->name('setting.update')->middleware('role:admin');
    Route::delete('/{id}', [SettingController::class, 'destroy'])->name('setting.destroy')->middleware('role:admin');
});



// CONTENT DUMMY
// Route::get('/ip', [GeoIPController::class, 'checkLocation']);
// Route::get('/ipconvert', [GeoIPController::class, 'currencyconvertbylokasi']);

// Route::get('/deposit', [DepositController::class, 'showDepositForm'])->name('deposit.form');
// Route::post('/deposit/process', [DepositController::class, 'processDeposit'])->name('deposit.process');


// Route::get('/paypal', [PaymentController::class, 'index']);
// Route::post('/pay', [PaymentController::class, 'paypal'])->name('paypal');
// Route::get('/success', [PaymentController::class, 'success'])->name('success');
// Route::get('/cancel', [PaymentController::class, 'cancel'])->name('cancel');
// CONTENT DUMMY



// CONTENT WESITE
Route::group([
    'middleware' => ["auth"],
], function ($router) {
Route::get('/profil', [WebsiteController::class, 'profil'])->name('website.profil')->middleware('role:user,admin');
Route::put('/profile/update', [WebsiteController::class, 'update'])->name('profile.update')->middleware('role:user,admin');
Route::post('/profile/update-password', [WebsiteController::class, 'updatePassword'])->name('profile.updatePassword')->middleware('role:user,admin');
});




// DEPOSIT USD
Route::group([
    'middleware' => ["auth"],
], function ($router) {
Route::get('/deposit_usd', [DepositUsdController::class, 'deposit_usd'])->name('website.deposit_usd')->middleware('role:user,admin');
Route::post('/pay', [DepositUsdController::class, 'deposit'])->name('paypal')->middleware('role:user,admin');
Route::get('/success', [DepositUsdController::class, 'success'])->name('success')->middleware('role:user,admin');
Route::get('/cancel', [DepositUsdController::class, 'cancel'])->name('cancel')->middleware('role:user,admin');
});





// DEPOSIT IDR
Route::group([
    'middleware' => ["auth"],
], function ($router) {
Route::get('/deposit_idr', [DepositIdrController::class, 'deposit_idr'])->name('website.deposit_idr')->middleware('role:user,admin');
Route::post('/deposit/process', [DepositIdrController::class, 'processDeposit'])->name('midtrans')->middleware('role:user,admin');
Route::get('/deposit/{order_id}/status', [DepositIdrController::class, 'checkTransactionStatus'])->middleware('role:user,admin');
Route::get('/invoice', [DepositIdrController::class, 'invoiceird'])->middleware('role:user');
});


// HISTORY DEPO
Route::group([
    'middleware' => ["auth"],
], function ($router) {
Route::get('/history', [HistoryController::class, 'history'])->middleware('role:user,admin');
});


// ORDER
Route::group([
    'middleware' => ["auth"],
], function ($router) {
Route::get('/order', [OrderProdukController::class, 'myorders'])->name('order')->middleware('role:user,admin');
Route::get('/beli-produk/{id}', [OrderProdukController::class, 'show'])->name('beli.produk.show')->middleware('role:user,admin');
Route::post('/konfirmasi-pembelian', [OrderProdukController::class, 'confirm'])->name('konfirmasi.pembelian')->middleware('role:user,admin');
Route::get('/download/{id}', [OrderProdukController::class, 'download'])->name('download')->middleware('role:user,admin');
});


  
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');



Route::get('/produkkategori/{id}', [FilteringController::class, 'indexByKategori']);
Route::get('/deskripsi/{id}', [WebsiteController::class, 'deskripsi'])->name('deskripsi.show');
