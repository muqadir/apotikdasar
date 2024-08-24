<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nota', 
        'totalharga', 
        'totaldiskon', 
        'totalpajak', 
        'harusbayar', 
        'jumlahdibayar', 
        'kembali', 
        'status'
    ];

    // public function penjualan()
    // {
    //     return $this->belongsTo(Penjualan::class, 'nota', 'nota');
    // }

    public static function joinBeli() {
        return $data =
        DB::table('pembayarans')
        ->join('pembelians', 'pembayarans.nota', '=', 'pembelians.faktur')
        ->join('suppliers', 'pembelians.supplier_id', '=', 'suppliers.id')
        ->join('users', 'pembelians.user_id', '=', 'users.id')
        ->select(
            'pembayarans.*', 
            'pembelians.tanggal',
            'pembelians.qty',
            'suppliers.name as supplier',
            'users.name',
            'pembelians.item'
        );

    }
    public static function joinJual() {
        return $data =
        DB::table('pembayarans')
        ->join('penjualans', 'pembayarans.nota', '=', 'penjualans.nota')
        ->join('obats', 'obats.id', '=', 'penjualans.item')
        ->join('stockobats', 'stockobats.obat_id', '=', 'obats.id')
        ->join('satuans', 'obats.satuan_id', '=', 'satuans.id')
        ->join('pasiens', 'penjualans.pasien_id', '=', 'pasiens.id')
        ->join('users', 'penjualans.user_id', '=', 'users.id')
        ->select(
            'penjualans.id as idPenjualan', 
            'penjualans.tanggal', 
            'penjualans.qty as Qty', 
            'penjualans.subtotal as hargaobat', 
            'obats.name as namaobat', 
            'satuans.satuan', 
            'pasiens.name as customer', 
            'users.name',
            'stockobats.jual',
            'pembayarans.*',
        );

    }
}
