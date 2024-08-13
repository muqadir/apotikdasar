<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'faktur',
        'item',
        'harga',
        'qty',
        'tanggal',
        'totalkotor',
        'pajak',
        'diskon',
        'totalbersih',
        'keterangan',
        'supplier_id',
        'user_id',
    ];

    // public static function simpan($data)
    // {
    //     // dd($request->all());
    //     $discount = ((int)$data['diskon'] / 100) * $data['subtotal'];
    //     $pajak = ((int)$data['pajak'] / 100) * $data['subtotal'];
    //     $bersih = ((int)$data['subtotal'] + $pajak) - $discount;
    //     $datas = [
    //         'faktur' => $data['faktur'],
    //         'item' => $data['item'],
    //         'harga' => $data['harga'],
    //         'qty' => $data['qty'],
    //         'tanggal' => $data['tanggal'],
    //         'totalkotor' => $data['subtotal'],
    //         'pajak' =>  $pajak,
    //         'diskon' => $discount,
    //         'totalbersih'  => $bersih,
    //         'keterangan' => $data['keterangan'],
    //         'supplier_id' => $data['supplier_id'],
    //         'user_id' => Auth::user()->id,

    //     ];
    //     return Pembelian::create($datas);
    // }

    public static function join(){
        return DB::table('pembelians')
        ->join('suppliers', 'suppliers.id', '=', 'pembelians.supplier_id')
        ->join('users', 'users.id', '=', 'pembelians.user_id');
    
    }

    public static function hitung(String $faktur)
    {
       return DB::table('pembelians')
       ->where('faktur', $faktur)
       ->selectRaw('sum(totalkotor) as totalKotor')
       ->selectRaw('sum(pajak) as totalPajak')
       ->selectRaw('sum(pajak) as totalPajak')
       ->selectRaw('sum(diskon) as totalDiskon')
       ->selectRaw('sum(totalbersih) as totalBersih');
    }

}


