<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\PeternakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\AdminLogin;
use App\Http\Middleware\OperatorLogin;
use App\Http\Middleware\PelangganLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('front.index');
Route::get('/search', [HomeController::class, 'search'])->name('front.search'); //ini belum bikin

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/signup', [AuthController::class, 'registrasiPembeli'])->name('signup');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/signup', [AuthController::class, 'registrasiPost'])->name('signup.post');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('ajax/notifikasi', [AjaxController::class, 'notifikasi'])->name('ajax.notifikasi');
Route::get('ajax/order-masuk', [AjaxController::class, 'orderMasuk'])->name('ajax.orderMasuk');
Route::get('ajax/updated-trx', [AjaxController::class, 'updatedTransaksi'])->name('ajax.updatedTransaksi');

Route::get('/profil', [HomeController::class, 'profil'])->name('front.profil')->middleware(PelangganLogin::class);
Route::get('/edit', [HomeController::class, 'editProfil'])->name('profil.edit')->middleware(PelangganLogin::class);
Route::post('/update-profil', [PelangganController::class, 'update'])->name('profil.update')->middleware(PelangganLogin::class);
Route::get('/order', [HomeController::class, 'orderList'])->name('front.order')->middleware(PelangganLogin::class);
Route::post('/order', [HomeController::class, 'orderPost'])->name('order')->middleware(PelangganLogin::class);
Route::post('/place-order', [HomeController::class, 'placeOrder'])->name('order.place')->middleware(PelangganLogin::class);
Route::get('/cart', [HomeController::class, 'cart'])->name('cart')->middleware(PelangganLogin::class);
Route::post('/cart/delete', [HomeController::class, 'deleteCart'])->name('cart.delete')->middleware(PelangganLogin::class);
Route::get('/checkout/{id}', [HomeController::class, 'checkout'])->name('checkout')->middleware(PelangganLogin::class);
Route::get('/order/{id}', [HomeController::class, 'detail'])->name('order.detail')->middleware(PelangganLogin::class);
Route::post('/order/upload', [HomeController::class, 'uploadBukti'])->name('order.upload')->middleware(PelangganLogin::class);

Route::get('/paid', [TransaksiController::class, 'paid'])->name('paid');
Route::get('/invoice/{id}', [LaporanController::class, 'invoice'])->name('invoice');


Route::prefix('admin')->middleware(AdminLogin::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
    Route::get('/profil', [AuthController::class, 'profil'])->name('admin.profil');
    Route::post('/ganti-password', [AuthController::class, 'gantiPassword'])->name('admin.gantiPassword');
    Route::get('/peternak', [PeternakController::class, 'index'])->name('peternak.index');
    Route::get('/peternak/tambah', [PeternakController::class, 'tambah'])->name('peternak.tambah');
    Route::get('/peternak/edit/{peternak_id}', [PeternakController::class, 'edit'])->name('peternak.edit');
    Route::get('/peternak/{peternak_id}', [PeternakController::class, 'view'])->name('peternak.detail');
    Route::post('/peternak/insert', [PeternakController::class, 'insert'])->name('peternak.insert');
    Route::post('/peternak/update', [PeternakController::class, 'update'])->name('peternak.update');
    Route::post('/peternak/delete', [PeternakController::class, 'delete'])->name('peternak.delete');

    Route::get('/operator', [OperatorController::class, 'index'])->name('operator.index');
    Route::get('/operator/tambah', [OperatorController::class, 'tambah'])->name('operator.tambah');
    Route::get('/operator/edit/{operator_id}', [OperatorController::class, 'edit'])->name('operator.edit');
    Route::get('/operator/{operator_id}', [OperatorController::class, 'view'])->name('operator.detail');
    Route::post('/operator/insert', [OperatorController::class, 'insert'])->name('operator.insert');
    Route::post('/operator/update', [OperatorController::class, 'update'])->name('operator.update');
    Route::post('/operator/delete', [OperatorController::class, 'delete'])->name('operator.delete');

    Route::get('/jenishewan', [HewanController::class, 'jenisHewan'])->name('jenishewan.index');
    Route::post('/jenishewan/insert', [HewanController::class, 'insertjenisHewan'])->name('jenishewan.insert');
    Route::post('/jenishewan/update', [HewanController::class, 'updatejenisHewan'])->name('jenishewan.update');
    Route::post('/jenishewan/delete', [HewanController::class, 'deletejenisHewan'])->name('jenishewan.delete');

    Route::get('/hewan', [HewanController::class, 'index'])->name('hewan.index');
    Route::get('/hewan/tambah', [HewanController::class, 'tambah'])->name('hewan.tambah');
    Route::get('/hewan/edit/{hewan_id}', [HewanController::class, 'edit'])->name('hewan.edit');
    Route::get('/hewan/{hewan_id}', [HewanController::class, 'view'])->name('hewan.detail');
    Route::post('/hewan/insert', [HewanController::class, 'insert'])->name('hewan.insert');
    Route::post('/hewan/update', [HewanController::class, 'update'])->name('hewan.update');
    Route::post('/hewan/delete', [HewanController::class, 'delete'])->name('hewan.delete');

    Route::get('/order', [TransaksiController::class, 'order'])->name('admin.order');
    Route::get('/order/detail/{id}', [TransaksiController::class, 'detailAdmin'])->name('admin.order.detail');
    Route::post('/order/proses', [TransaksiController::class, 'prosesPost'])->name('admin.order.proses');
    Route::post('/order/selesai', [TransaksiController::class, 'selesaiPost'])->name('admin.order.selesai');

    Route::get('/order/masuk', [TransaksiController::class, 'masuk'])->name('admin.order.masuk');
    Route::get('/order/diproses', [TransaksiController::class, 'diproses'])->name('admin.order.diproses');
    Route::get('/order/selesai', [TransaksiController::class, 'selesai'])->name('admin.order.selesai');
    Route::get('/laporan', [LaporanController::class, 'transaksi'])->name('admin.laporan');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('admin.cetak-laporan');
});
Route::prefix('operator')->middleware(OperatorLogin::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('operator');
    Route::get('/profil', [AuthController::class, 'profil'])->name('operator.profil');
    Route::post('/ganti-password', [AuthController::class, 'gantiPassword'])->name('operator.gantiPassword');
    Route::get('/peternak', [PeternakController::class, 'index'])->name('peternak.index');
    Route::get('/peternak/tambah', [PeternakController::class, 'tambah'])->name('peternak.tambah');
    Route::get('/peternak/edit/{peternak_id}', [PeternakController::class, 'edit'])->name('peternak.edit');
    Route::get('/peternak/{peternak_id}', [PeternakController::class, 'view'])->name('peternak.detail');
    Route::post('/peternak/insert', [PeternakController::class, 'insert'])->name('peternak.insert');
    Route::post('/peternak/update', [PeternakController::class, 'update'])->name('peternak.update');
    Route::post('/peternak/delete', [PeternakController::class, 'delete'])->name('peternak.delete');

    Route::get('/operator', [OperatorController::class, 'index'])->name('operator.index');
    Route::get('/operator/tambah', [OperatorController::class, 'tambah'])->name('operator.tambah');
    Route::get('/operator/edit/{operator_id}', [OperatorController::class, 'edit'])->name('operator.edit');
    Route::get('/operator/{operator_id}', [OperatorController::class, 'view'])->name('operator.detail');
    Route::post('/operator/insert', [OperatorController::class, 'insert'])->name('operator.insert');
    Route::post('/operator/update', [OperatorController::class, 'update'])->name('operator.update');
    Route::post('/operator/delete', [OperatorController::class, 'delete'])->name('operator.delete');

    Route::get('/jenishewan', [HewanController::class, 'jenisHewan'])->name('jenishewan.index');
    Route::post('/jenishewan/insert', [HewanController::class, 'insertjenisHewan'])->name('jenishewan.insert');
    Route::post('/jenishewan/update', [HewanController::class, 'updatejenisHewan'])->name('jenishewan.update');
    Route::post('/jenishewan/delete', [HewanController::class, 'deletejenisHewan'])->name('jenishewan.delete');

    Route::get('/hewan', [HewanController::class, 'index'])->name('operator.hewan.index');
    Route::get('/hewan/tambah', [HewanController::class, 'tambah'])->name('operator.hewan.tambah');
    Route::get('/hewan/edit/{hewan_id}', [HewanController::class, 'edit'])->name('operator.hewan.edit');
    Route::get('/hewan/{hewan_id}', [HewanController::class, 'view'])->name('operator.hewan.detail');
    Route::post('/hewan/insert', [HewanController::class, 'insert'])->name('operator.hewan.insert');
    Route::post('/hewan/update', [HewanController::class, 'update'])->name('operator.hewan.update');
    Route::post('/hewan/delete', [HewanController::class, 'delete'])->name('operator.hewan.delete');

    Route::get('/order', [TransaksiController::class, 'order'])->name('operator.order');
    Route::get('/order/detail/{id}', [TransaksiController::class, 'detailAdmin'])->name('operator.order.detail');
    Route::post('/order/proses', [TransaksiController::class, 'prosesPost'])->name('operator.order.proses');
    Route::post('/order/selesai', [TransaksiController::class, 'selesaiPost'])->name('operator.order.selesai');

    Route::get('/order/masuk', [TransaksiController::class, 'masuk'])->name('operator.order.masuk');
    Route::get('/order/diproses', [TransaksiController::class, 'diproses'])->name('operator.order.diproses');
    Route::get('/order/selesai', [TransaksiController::class, 'selesai'])->name('operator.order.selesai');
    Route::get('/laporan', [LaporanController::class, 'transaksi'])->name('operator.laporan');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('operator.cetak-laporan');
});
