<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockobatController;
use App\Http\Controllers\AdminPanelController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

    Route::post('getobat', [StockobatController::class, 'getObat'])->name('stock.getobat');
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

