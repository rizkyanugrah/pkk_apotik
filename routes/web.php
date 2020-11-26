<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');

        Route::resource('satuan', 'Admin\SatuanController');
        Route::resource('jenis', 'Admin\JenisController');
        Route::resource('kategori', 'Admin\kategoriController');
        Route::resource('obat', 'Admin\ObatController');
        Route::resource('karyawan', 'Admin\KaryawanController');
        Route::resource('supplier', 'Admin\SupplierController');

        Route::resource('obat_keluar', 'Admin\ObatKeluarController');
        Route::resource('transaksi_jual', 'Admin\TransaksiJualController');
        Route::resource('pembelian', 'Admin\TransaksiPembelianController');
        Route::resource('laporan', 'Admin\LaporanController');
        Route::resource('cart', 'Admin\CartController');
    });
});
