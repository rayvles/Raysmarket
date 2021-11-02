<?php

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\ProdukController;

Route::prefix('/admin')->group(function(){
    Route::get('/', [AdminPageController::class, 'index']);
    Route::get('/tableproduk', [AdminPageController::class, 'tableproduk']);
    
});

Route::resource('produk', ProdukController::class,);
Route::resource('barang', BarangController::class,);
Route::resource('pelanggan', PelangganController::class,);
Route::resource('pemasok', PemasokController::class,);

Route::get('/admin/tableproduk', [produkController::class, 'index']);
Route::get('/admin/tablebarang', [BarangController::class, 'index']);
Route::get('/admin/tablepelanggan', [PelangganController::class, 'index']);
Route::get('/admin/tablepemasok', [PemasokController::class, 'index']);

// pembelian
Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
Route::get('/pembelian/detail/data/{id}', [PembelianController::class, 'detail_data'])->name('pembelian.detail');
Route::get('/pembelian/new-transaksi', [PembelianController::class, 'create'])->name('pembelian.create');
Route::resource('/pembelian', PembelianController::class)->except('create', 'edit');



