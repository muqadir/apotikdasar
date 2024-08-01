<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nota',
        'status',
        'tanggal',
        'qty',
        'pajak',
        'diskon',
        'subtotal',
        'item',
        'user_id',
        'pasien_id',
    ];

    public static function  join() 
    {
        return $data = DB::table('penjualans')
            ->join('obats', 'obats.id', '=', 'penjualans.item')
            ->join('pasiens', 'pasiens.id', '=', 'penjualans.pasien_id')
            ->join('stockobats', 'stockobats.obat_id', '=', 'obats.id')
            ->join('users', 'users.id', '=', 'penjualans.user_id')
            ->select('penjualans.*', 'obats.name as namaobat', 'users.name', 'stockobats.jual', 'pasiens.name as costumer');
    }

    public static function hitung($id)
    {
        $data = Penjualan::where('nota', $id)
            ->selectRaw('SUM(subtotal) as totalHarga')
            ->selectRaw('nota')
            ->groupBy('nota');
        return $data;
    }

    public static function JoinCetak() {
        return $data = DB::table('penjualans')
        ->join('obats', 'obats.id', '=', 'penjualans.item')
        ->join('satuans', 'obats.satuan_id', '=', 'satuans.id') 
        ->join('pasiens', 'pasiens.id', '=', 'penjualans.pasien_id')
        ->join('stockobats', 'stockobats.obat_id', '=', 'obats.id')
        ->join('users', 'users.id', '=', 'penjualans.user_id')
        ->join('pembayarans', 'pembayarans.nota', '=', 'penjualans.nota')
        ->select(
            'penjualans.*',
            'obats.name as namaobat',
            'obats.indikasi',
            'obats.dosis',
            'satuans.satuan',
            'pasiens.name as costumer',
            'pasiens.alamat',
            'pasiens.telp',
            'users.name',
            'pembayarans.totalharga',
            'pembayarans.totaldiskon',
            'pembayarans.harusbayar',
            'pembayarans.jumlahdibayar',
            'pembayarans.kembali',
            'stockobats.jual'
            );
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'nota', 'nota');
    }


}
