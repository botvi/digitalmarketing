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
    OrderProdukController
    
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
    Route::get('/get-sub-kategoris/{kategori_id}', [ProdukController::class, 'getSubKategorisByKategoriId'])->middleware('role:admin');
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
Route::get('/', [WebsiteController::class, 'index'])->name('website.index');
Route::get('/profil', [WebsiteController::class, 'profil'])->name('website.profil');
Route::put('/profile/update', [WebsiteController::class, 'update'])->name('profile.update');
Route::post('/profile/update-password', [WebsiteController::class, 'updatePassword'])->name('profile.updatePassword');

// REG
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Menangani proses logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// DEPOSIT USD
Route::get('/deposit_usd', [DepositUsdController::class, 'deposit_usd'])->name('website.deposit_usd');
Route::post('/pay', [DepositUsdController::class, 'deposit'])->name('paypal');
Route::get('/success', [DepositUsdController::class, 'success'])->name('success');
Route::get('/cancel', [DepositUsdController::class, 'cancel'])->name('cancel');






// DEPOSIT IDR
Route::get('/deposit_idr', [DepositIdrController::class, 'deposit_idr'])->name('website.deposit_idr');
Route::post('/deposit/process', [DepositIdrController::class, 'processDeposit'])->name('midtrans');
Route::get('/deposit/{order_id}/status', [DepositIdrController::class, 'checkTransactionStatus']);
Route::get('/invoice', [DepositIdrController::class, 'invoiceird']);



// HISTORY DEPO
Route::get('/history', [HistoryController::class, 'history']);



// ORDER
Route::get('/order', [OrderProdukController::class, 'myorders']);

Route::get('/beli-produk/{id}', [OrderProdukController::class, 'show'])->name('beli.produk.show');
Route::post('/konfirmasi-pembelian', [OrderProdukController::class, 'confirm'])->name('konfirmasi.pembelian');
