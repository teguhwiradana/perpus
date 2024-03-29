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
/*
Route::get('/', function () {
    return view('home');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
/*
Route::get('/user', 'UserController@index');
Route::get('/user-register', 'UserController@create');
Route::post('/user-register', 'UserController@store');
Route::get('/user-edit/{id}', 'UserController@edit');
*/
Route::resource('user', 'UserController');

Route::resource('anggota', 'AnggotaController');

Route::resource('buku', 'BukuController');
Route::get('/format_buku', 'BukuController@format');
Route::post('/import_buku', 'BukuController@import');

Route::resource('transaksi', 'TransaksiController');
Route::get('/kembali','TransaksiKembaliController@index')->name('transaksi.kembali');
Route::get('/check/{id}','TransaksiKembaliController@checktransaksi')->name('transaksi.check');
Route::post('/perpanjang/{id}','TransaksiKembaliController@perpanjang')->name('transaksi.perpanjang');
Route::get('/laporan/trs', 'LaporanController@transaksi');
Route::get('/laporan/trs/pdf', 'LaporanController@transaksiPdf');
Route::get('/laporan/trs/excel', 'LaporanController@transaksiExcel');
Route::get('/laporan/pinjam','LaporanController@pinjam')->name('laporan.pinjam');
Route::get('/laporan/kembali','LaporanController@kembali')->name('laporan.kembali');
Route::get('/laporan/denda','LaporanController@denda')->name('laporan.denda');
Route::get('/laporan/denda2','LaporanController@denda2')->name('laporan.denda2');

Route::get('/laporan/buku', 'LaporanController@buku');
Route::get('/laporan/buku/pdf', 'LaporanController@bukuPdf');
Route::get('/laporan/buku/excel', 'LaporanController@bukuExcel');


