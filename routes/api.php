<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StockobatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('getobat', [StockobatController::class, 'getObat'])->name('getobat');
Route::post('getdataobat', [StockobatController::class, 'getDataObat'])->name('getdataobat');
Route::post('gethitung', [PenjualanController::class, 'getHitung'])->name('gethitung');
Route::post('cariKode', [ObatController::class,  'cariKode'])->name('cariKode');

Route::get('datapembelian', [PembelianController::class, 'DataPembelian'])->name('datapembelian');
Route::post('prosesspembayaran', [PembelianController::class, 'ProsessPembayaran'])->name('prosessbayar');
Route::post('detailsjual', [LaporanController::class, 'DetailPenjualan'])->name('detailsjual');
Route::post('detailsbeli', [LaporanController::class, 'DetailPembelian'])->name('detailsbeli');
