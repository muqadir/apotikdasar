<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'kode',
        'dosis',
        'indikasi',
        'kategori_id',
        'satuan_id',
        'ready',
    ];

    public static function join()
    {
        $data = DB::table('obats')
        ->join('kategoris','obats.kategori_id', 'kategoris.id')
        ->join('satuans','obats.satuan_id', 'satuans.id')
        ->select('obats.*', 'satuans.satuan as satuans', 'kategoris.kategori as kategoris' );
        return $data;
    }
    public static function joinStock()
    {
        $data = DB::table('stockobats')
        ->join('obats','stockobats.obat_id', 'obats.id')
        ->select('stockobats.*', 'obats.name as namaObat', 'obats.id as obatid' )
        ->get();
        return $data;
    }
}
