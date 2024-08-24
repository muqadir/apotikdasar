<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\OpnameController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StockobatController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\PembayaranController;

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


require __DIR__.'/auth.php';

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([ 'middleware' => ['role:superadmin']], function() {

    Route::get('supplier/', [SupplierController::class, 'index'])->name('supplier.index');
    Route::post('supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::post('supplier/updates', [SupplierController::class, 'updates'])->name('supplier.updates');
    Route::post('supplier/edits', [SupplierController::class, 'edits'])->name('supplier.edits');
    Route::post('supplier/hapus', [SupplierController::class, 'destroy'])->name('supplier.hapus');
    
    Route::get('obat/', [ObatController::class, 'index'])->name('obat.index');
    Route::post('obat/store', [ObatController::class, 'store'])->name('obat.store');
    Route::post('obat/updates', [ObatController::class, 'updates'])->name('obat.updates');
    Route::post('obat/edits', [ObatController::class, 'edits'])->name('obat.edits');
    Route::post('obat/hapus', [ObatController::class, 'destroy'])->name('obat.hapus');

    Route::get('stock/', [StockobatController::class, 'index'])->name('stock.index');
    Route::post('stock/store', [StockobatController::class, 'store'])->name('stock.store');
    Route::post('stock/updates', [StockobatController::class, 'updates'])->name('stock.updates');
    Route::post('stock/edits', [StockobatController::class, 'edits'])->name('stock.edits');
    Route::post('stock/hapus', [StockobatController::class, 'destroy'])->name('stock.hapus');

    Route::get('opname/',  [OpnameController::class, 'index'])->name('opname.index');
    Route::post('opname/store',  [OpnameController::class, 'store'])->name('opname.store');
    // Route::get('opname/databeli',  [OpnameController::class, 'DataBeli'])->name('opname.databeli');
    // Route::get('opname/datajual',  [OpnameController::class, 'DataJual'])->name('opname.datajual');
    
    Route::get('belanja/', [PembelianController::class, 'index'])->name('belanja.index');
    Route::post('belanja/store', [PembelianController::class, 'store'])->name('belanja.store');
    Route::get('belanja/datapembelian', [PembelianController::class, 'DataPembelian'])->name('belanja.datapembelian');
    Route::post('belanja/hapus', [PembelianController::class, 'destroy'])->name('belanja.hapus');


    Route::get('penjualan/', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::post('penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::post('penjualan/hapus', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    Route::get('penjualan/datapenjualan', [PenjualanController::class, 'DataPenjualan'])->name('penjualan.datapenjualan');
    Route::post('penjualan/cetak', [PenjualanController::class, 'CetakNota'])->name('penjualan.cetak');

    // Route::post('getobat', [StockobatController::class, 'getObat'])->name('stock.getobat');
    // Route::post('getdataobat', [StockobatController::class, 'getDataObat'])->name('stock.getdataobat');
    // Route::post('gethitung', [PenjualanController::class, 'getHitung'])->name('penjualan.gethitung');

    
    Route::get('pembayaran/', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::post('pembayaran/cetak', [PembayaranController::class, 'CetakNota'])->name('pembayaran.cetak');
    
    Route::get('laporan/', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/penjualan', [LaporanController::class, 'dataTablePenjualan'])->name('laporan.penjualan');
    Route::get('laporan/belanja', [LaporanController::class, 'dataTablePembelian'])->name('laporan.belanja');
    Route::get('laporan/exportpembayaran', [ ExportController::class, 'LapPembayaran'])->name('laporan.exportpembayaran');



    // Manajemen User
    Route::get('management/', [AdminPanelController::class, 'index'])->name('management.index');
    Route::post('management/store', [AdminPanelController::class, 'store'])->name('management.store');
    Route::post('management/getrole', [AdminPanelController::class, 'getRole'])->name('management.getrole');
    Route::post('management/update', [AdminPanelController::class, 'update'])->name('management.update');
    Route::post('management/hapususer', [AdminPanelController::class,'hapusUser'])->name('management.hapususer');

    // Manajemen Permission
    Route::get('management/loadpermission', [AdminPanelController::class, 'LoadPermission'])->name('management.loadpermission');
    Route::post('management/simpanpermission', [AdminPanelController::class, 'simpanpermission'])->name('management.simpanpermission');

     // Manajemen Permission
     Route::get('management/loadrole', [AdminPanelController::class, 'LoadRole'])->name('management.loadrole');
     Route::post('management/simpanrole', [AdminPanelController::class, 'simpanRole'])->name('management.simpanrole');
     Route::post('management/roleinfo', [AdminPanelController::class, 'roleInfo'])->name('management.roleinfo');
     Route::post('management/roleedit', [AdminPanelController::class, 'roleEdit'])->name('management.roleedit');


});

