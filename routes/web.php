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

Auth::routes(['register'=>false]);//['register'=>false]
Route::middleware('auth')->group(function () {
	//Profil
	Route::get('/profil', 'ProfilController@index')->name('profil');
	Route::post('/profil/{id_user}', 'ProfilController@update')->name('profil.update');
	
	// Dashboard
	Route::get('/', 'DashboardController@index');
	Route::post('/databarangsisa', 'DashboardController@dataBarangSisa')->name('databarangsisa');

	// Barang
	Route::get('/barang', 'BarangController@index');
	Route::get('/barang/{id_barang}/edit', 'BarangController@edit')->name('barang.edit');
	Route::get('/barang/{id_barang}/delete', 'BarangController@delete')->name('barang.delete');
	Route::post('/databarang', 'BarangController@dataBarang')->name('databarang');
	Route::post('/barang/store', 'BarangController@store')->name('barang.store');
	Route::post('/barang/{id_barang}/update', 'BarangController@update')->name('barang.update');

	//Penjualan
	Route::get('/penjualan', 'PenjualanController@index');
	Route::get('/getHargaJual/{id_barang}', 'PenjualanController@getHargaJual');
	Route::get('/getDetailJual/{id_penjualan}', 'PenjualanController@getDetailJual')->name('penjualan.detail');
	Route::post('/datapenjualan', 'PenjualanController@dataPenjualan')->name('datapenjualan');
	Route::post('/penjualan/store', 'PenjualanController@store')->name('penjualan.add');
	Route::get('/cekStock/{id_barang}/{jumlah}', 'PenjualanController@cekStock');

	//Pembelian
	Route::get('/pembelian', 'PembelianController@index');
	Route::get('/getHargaBeli/{id_barang}', 'PembelianController@getHargaBeli');
	Route::get('/getDetailBeli/{id_pembelian}', 'PembelianController@getDetailBeli')->name('pembelian.detail');
	Route::post('/datapembelian', 'PembelianController@dataPembelian')->name('datapembelian');
	Route::post('/pembelian/store', 'PembelianController@store')->name('pembelian.add');

	//Jurnal
	Route::get('/jurnal', 'JurnalController@index');
	Route::get('/getJurnal/{tgl_awal}/{tgl_akhir}/{limit}', 'JurnalController@getJurnal');
	Route::get('/jurnal/export_excel/{tgl_awal}/{tgl_akhir}', 'JurnalController@export_excel');
});