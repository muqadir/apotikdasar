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

    public static function  join() {
        return   $data = DB::table('penjualans')
    ->join('obats', 'obats.id', '=', 'penjualans.item')
    ->join('pasiens', 'pasiens.id', '=', 'penjualans.pasien_id')
    ->join('stockobats', 'stockobats.obat_id', '=', 'obats.id')
    ->join('users', 'users.id', '=', 'penjualans.user_id')
    ->select('penjualans.*', 'obats.name as namaobat', 'users.name', 'stockobats.jual', 'pasiens.name as costumer');
    }
}
