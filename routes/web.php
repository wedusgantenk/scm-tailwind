<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

Route::get('change/password', [App\Http\Controllers\Admin\SettingsController::class, 'updatePasswordForm'])
    ->name('update.password')
    ->middleware('auth');

Route::post('change/password', [App\Http\Controllers\Admin\SettingsController::class, 'updatePassword'])
    ->middleware('auth');

Route::get('jenisbarang', [App\Http\Controllers\Admin\JenisBarangController::class, 'index'])->name('admin.jenis_barang')->middleware(['checkRole:admin']);
Route::get('jenisbarang/create', [App\Http\Controllers\Admin\JenisBarangController::class, 'create'])->name('admin.jenis_barang.create')->middleware(['checkRole:admin']);
Route::post('jenisbarang/create', [App\Http\Controllers\Admin\JenisBarangController::class, 'store'])->name('admin.jenis_barang.store')->middleware(['checkRole:admin']);
Route::get('jenisbarang/edit/{id}', [App\Http\Controllers\Admin\JenisBarangController::class, 'edit'])->name('admin.jenis_barang.edit')->middleware(['checkRole:admin']);
Route::patch('jenisbarang/edit/{id}/update', [App\Http\Controllers\Admin\JenisBarangController::class, 'update'])->name('admin.jenis_barang.update')->middleware(['checkRole:admin']);
Route::get('jenisbarang/delete/{id}', [App\Http\Controllers\Admin\JenisBarangController::class, 'destroy'])->name('admin.jenis_barang.delete')->middleware(['checkRole:admin']);

Route::get('barang', [App\Http\Controllers\Admin\BarangController::class, 'index'])->name('admin.barang')->middleware(['checkRole:admin']);
Route::get('barang/create', [App\Http\Controllers\Admin\BarangController::class, 'create'])->name('admin.barang.create')->middleware(['checkRole:admin']);
Route::post('barang/create', [App\Http\Controllers\Admin\BarangController::class, 'store'])->name('admin.barang.store')->middleware(['checkRole:admin']);
Route::get('barang/edit/{id}', [App\Http\Controllers\Admin\BarangController::class, 'edit'])->name('admin.barang.edit')->middleware(['checkRole:admin']);
Route::patch('barang/edit/{id}/update', [App\Http\Controllers\Admin\BarangController::class, 'update'])->name('admin.barang.update')->middleware(['checkRole:admin']);
Route::get('barang/delete/{id}', [App\Http\Controllers\Admin\BarangController::class, 'destroy'])->name('admin.barang.delete')->middleware(['checkRole:admin']);
Route::get('barang/import', [App\Http\Controllers\Admin\BarangController::class, 'import'])->name('admin.barang.import')->middleware(['checkRole:admin']);
Route::post('barang/import', [App\Http\Controllers\Admin\BarangController::class, 'import_excel'])->name('admin.barang.import_excel')->middleware(['checkRole:admin']);

Route::get('bts', [App\Http\Controllers\Admin\BtsController::class, 'index'])->name('admin.bts')->middleware(['checkRole:admin']);
Route::get('bts/create', [App\Http\Controllers\Admin\BtsController::class, 'create'])->name('admin.bts.create')->middleware(['checkRole:admin']);
Route::post('bts/create', [App\Http\Controllers\Admin\BtsController::class, 'store'])->name('admin.bts.store')->middleware(['checkRole:admin']);
Route::get('bts/edit/{id}', [App\Http\Controllers\Admin\BtsController::class, 'edit'])->name('admin.bts.edit')->middleware(['checkRole:admin']);
Route::patch('bts/edit/{id}/update', [App\Http\Controllers\Admin\BtsController::class, 'update'])->name('admin.bts.update')->middleware(['checkRole:admin']);
Route::get('bts/delete/{id}', [App\Http\Controllers\Admin\BtsController::class, 'destroy'])->name('admin.bts.delete')->middleware(['checkRole:admin']);

Route::get('warehouse', [App\Http\Controllers\Admin\WarehouseController::class, 'index'])->name('admin.warehouse')->middleware(['checkRole:admin']);
Route::get('warehouse/create', [App\Http\Controllers\Admin\WarehouseController::class, 'create'])->name('admin.warehouse.create')->middleware(['checkRole:admin']);
Route::post('warehouse/create', [App\Http\Controllers\Admin\WarehouseController::class, 'store'])->name('admin.warehouse.store')->middleware(['checkRole:admin']);
Route::get('warehouse/edit/{id}', [App\Http\Controllers\Admin\WarehouseController::class, 'edit'])->name('admin.warehouse.edit')->middleware(['checkRole:admin']);
Route::patch('warehouse/edit/{id}/update', [App\Http\Controllers\Admin\WarehouseController::class, 'update'])->name('admin.warehouse.update')->middleware(['checkRole:admin']);
Route::get('warehouse/delete/{id}', [App\Http\Controllers\Admin\WarehouseController::class, 'destroy'])->name('admin.warehouse.delete')->middleware(['checkRole:admin']);

Route::get('cabang', [App\Http\Controllers\Admin\CabangController::class, 'index'])->name('admin.cabang')->middleware(['checkRole:admin']);
Route::get('cabang/create', [App\Http\Controllers\Admin\CabangController::class, 'create'])->name('admin.cabang.create')->middleware(['checkRole:admin']);
Route::post('cabang/create', [App\Http\Controllers\Admin\CabangController::class, 'store'])->name('admin.cabang.store')->middleware(['checkRole:admin']);
Route::get('cabang/edit/{id}', [App\Http\Controllers\Admin\CabangController::class, 'edit'])->name('admin.cabang.edit')->middleware(['checkRole:admin']);
Route::patch('cabang/edit/{id}/update', [App\Http\Controllers\Admin\CabangController::class, 'update'])->name('admin.cabang.update')->middleware(['checkRole:admin']);
Route::get('cabang/delete/{id}', [App\Http\Controllers\Admin\CabangController::class, 'destroy'])->name('admin.cabang.delete')->middleware(['checkRole:admin']);

Route::get('transaksi/distribusi_cabang', [App\Http\Controllers\Admin\TransaksiCabangController::class, 'index'])->name('admin.transaksi.distribusi_cabang')->middleware(['checkRole:admin']);
Route::get('transaksi/distribusi_cabang/create', [App\Http\Controllers\Admin\TransaksiCabangController::class, 'create'])->name('admin.transaksi.distribusi_cabang.create')->middleware(['checkRole:admin']);
Route::post('transaksi/distribusi_cabang/create', [App\Http\Controllers\Admin\TransaksiCabangController::class, 'store'])->name('admin.transaksi.distribusi_cabang.store')->middleware(['checkRole:admin']);
Route::get('transaksi/distribusi_cabang/edit/{id}', [App\Http\Controllers\Admin\TransaksiCabangController::class, 'edit'])->name('admin.transaksi.distribusi_cabang.edit')->middleware(['checkRole:admin']);
Route::patch('transaksi/distribusi_cabang/edit/{id}/update', [App\Http\Controllers\Admin\TransaksiCabangController::class, 'update'])->name('admin.transaksi.distribusi_cabang.update')->middleware(['checkRole:admin']);
Route::get('transaksi/distribusi_cabang/delete/{id}', [App\Http\Controllers\Admin\TransaksiCabangController::class, 'destroy'])->name('admin.transaksi.distribusi_cabang.delete')->middleware(['checkRole:admin']);

Route::get('transaksi/distribusi_sales', [App\Http\Controllers\Admin\TransaksiSalesController::class, 'index'])->name('admin.transaksi.distribusi_sales')->middleware(['checkRole:admin']);
Route::get('transaksi/distribusi_sales/create', [App\Http\Controllers\Admin\TransaksiSalesController::class, 'create'])->name('admin.transaksi.distribusi_sales.create')->middleware(['checkRole:admin']);
Route::post('transaksi/distribusi_sales/create', [App\Http\Controllers\Admin\TransaksiSalesController::class, 'store'])->name('admin.transaksi.distribusi_sales.store')->middleware(['checkRole:admin']);
Route::get('transaksi/distribusi_sales/edit/{id}', [App\Http\Controllers\Admin\TransaksiSalesController::class, 'edit'])->name('admin.transaksi.distribusi_sales.edit')->middleware(['checkRole:admin']);
Route::patch('transaksi/distribusi_sales/edit/{id}/update', [App\Http\Controllers\Admin\TransaksiSalesController::class, 'update'])->name('admin.transaksi.distribusi_sales.update')->middleware(['checkRole:admin']);
Route::get('transaksi/distribusi_sales/delete/{id}', [App\Http\Controllers\Admin\TransaksiSalesController::class, 'destroy'])->name('admin.transaksi.distribusi_sales.delete')->middleware(['checkRole:admin']);

Route::get('jenisoutlet', [App\Http\Controllers\Admin\JenisOutletController::class, 'index'])->name('admin.jenis_outlet')->middleware(['checkRole:admin']);
Route::get('jenisoutlet/create', [App\Http\Controllers\Admin\JenisOutletController::class, 'create'])->name('admin.jenis_outlet.create')->middleware(['checkRole:admin']);
Route::post('jenisoutlet/create', [App\Http\Controllers\Admin\JenisOutletController::class, 'store'])->name('admin.jenis_outlet.store')->middleware(['checkRole:admin']);
Route::get('jenisoutlet/edit/{id}', [App\Http\Controllers\Admin\JenisOutletController::class, 'edit'])->name('admin.jenis_outlet.edit')->middleware(['checkRole:admin']);
Route::patch('jenisoutlet/edit/{id}/update', [App\Http\Controllers\Admin\JenisOutletController::class, 'update'])->name('admin.jenis_outlet.update')->middleware(['checkRole:admin']);
Route::get('jenisoutlet/delete/{id}', [App\Http\Controllers\Admin\JenisOutletController::class, 'destroy'])->name('admin.jenis_outlet.delete')->middleware(['checkRole:admin']);

Route::get('outlet', [App\Http\Controllers\Admin\OutletController::class, 'index'])->name('admin.outlet')->middleware(['checkRole:admin']);
Route::get('outlet/create', [App\Http\Controllers\Admin\OutletController::class, 'create'])->name('admin.outlet.create')->middleware(['checkRole:admin']);
Route::post('outlet/create', [App\Http\Controllers\Admin\OutletController::class, 'store'])->name('admin.outlet.store')->middleware(['checkRole:admin']);
Route::get('outlet/edit/{id}', [App\Http\Controllers\Admin\OutletController::class, 'edit'])->name('admin.outlet.edit')->middleware(['checkRole:admin']);
Route::patch('outlet/edit/{id}/update', [App\Http\Controllers\Admin\OutletController::class, 'update'])->name('admin.outlet.update')->middleware(['checkRole:admin']);
Route::get('outlet/delete/{id}', [App\Http\Controllers\Admin\OutletController::class, 'destroy'])->name('admin.outlet.delete')->middleware(['checkRole:admin']);

Route::get('petugas', [App\Http\Controllers\Admin\PetugasController::class, 'index'])->name('admin.petugas')->middleware(['checkRole:admin']);
Route::get('petugas/create', [App\Http\Controllers\Admin\PetugasController::class, 'create'])->name('admin.petugas.create')->middleware(['checkRole:admin']);
Route::post('petugas/create', [App\Http\Controllers\Admin\PetugasController::class, 'store'])->name('admin.petugas.store')->middleware(['checkRole:admin']);
Route::get('petugas/edit/{id}', [App\Http\Controllers\Admin\PetugasController::class, 'edit'])->name('admin.petugas.edit')->middleware(['checkRole:admin']);
Route::patch('petugas/edit/{id}/update', [App\Http\Controllers\Admin\PetugasController::class, 'update'])->name('admin.petugas.update')->middleware(['checkRole:admin']);
Route::get('petugas/delete/{id}', [App\Http\Controllers\Admin\PetugasController::class, 'destroy'])->name('admin.petugas.delete')->middleware(['checkRole:admin']);

Route::get('barangmasuk', [App\Http\Controllers\Admin\BarangMasukController::class, 'index'])->name('admin.barang_masuk')->middleware(['checkRole:admin']);
Route::get('barangmasuk/create', [App\Http\Controllers\Admin\BarangMasukController::class, 'create'])->name('admin.barang_masuk.create')->middleware(['checkRole:admin']);
Route::post('barangmasuk/create', [App\Http\Controllers\Admin\BarangMasukController::class, 'store'])->name('admin.barang_masuk.store')->middleware(['checkRole:admin']);
Route::get('barangmasuk/edit/{id}', [App\Http\Controllers\Admin\BarangMasukController::class, 'edit'])->name('admin.barang_masuk.edit')->middleware(['checkRole:admin']);
Route::patch('barangmasuk/edit/{id}/update', [App\Http\Controllers\Admin\BarangMasukController::class, 'update'])->name('admin.barang_masuk.update')->middleware(['checkRole:admin']);
Route::get('barangmasuk/delete/{id}', [App\Http\Controllers\Admin\BarangMasukController::class, 'destroy'])->name('admin.barang_masuk.delete')->middleware(['checkRole:admin']);
Route::get('barangmasuk/import', [App\Http\Controllers\Admin\BarangMasukController::class, 'import'])->name('admin.barang_masuk.import')->middleware(['checkRole:admin']);
Route::post('barangmasuk/import', [App\Http\Controllers\Admin\BarangMasukController::class, 'import_excel'])->name('admin.barang_masuk.import_excel')->middleware(['checkRole:admin']);


Route::get('hargabarang', [App\Http\Controllers\Admin\HargaBarangController::class, 'index'])->name('admin.harga_barang')->middleware(['checkRole:admin']);
Route::get('hargabarang/create', [App\Http\Controllers\Admin\HargaBarangController::class, 'create'])->name('admin.harga_barang.create')->middleware(['checkRole:admin']);
Route::post('hargabarang/create', [App\Http\Controllers\Admin\HargaBarangController::class, 'store'])->name('admin.harga_barang.store')->middleware(['checkRole:admin']);
Route::get('hargabarang/edit/{id}', [App\Http\Controllers\Admin\HargaBarangController::class, 'edit'])->name('admin.harga_barang.edit')->middleware(['checkRole:admin']);
Route::patch('hargabarang/edit/{id}/update', [App\Http\Controllers\Admin\HargaBarangController::class, 'update'])->name('admin.harga_barang.update')->middleware(['checkRole:admin']);
Route::get('hargabarang/delete/{id}', [App\Http\Controllers\Admin\HargaBarangController::class, 'destroy'])->name('admin.harga_barang.delete')->middleware(['checkRole:admin']);

Route::get('detailbarang', [App\Http\Controllers\Admin\DetailBarangController::class, 'index'])->name('admin.detail_barang')->middleware(['checkRole:admin']);
Route::get('detailbarang/create', [App\Http\Controllers\Admin\DetailBarangController::class, 'create'])->name('admin.detail_barang.create')->middleware(['checkRole:admin']);
Route::post('detailbarang/create', [App\Http\Controllers\Admin\DetailBarangController::class, 'store'])->name('admin.detail_barang.store')->middleware(['checkRole:admin']);
Route::get('detailbarang/edit/{id}', [App\Http\Controllers\Admin\DetailBarangController::class, 'edit'])->name('admin.detail_barang.edit')->middleware(['checkRole:admin']);
Route::patch('detailbarang/edit/{id}/update', [App\Http\Controllers\Admin\DetailBarangController::class, 'update'])->name('admin.detail_barang.update')->middleware(['checkRole:admin']);
Route::get('detailbarang/delete/{id}', [App\Http\Controllers\Admin\DetailBarangController::class, 'destroy'])->name('admin.detail_barang.delete')->middleware(['checkRole:admin']);
