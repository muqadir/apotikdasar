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
    ];

    public static function join()
    {
        $data = DB::table('obats')
        ->join('kategoris','obats.kategori_id', 'kategoris.id')
        ->join('satuans','obats.satuan_id', 'satuans.id')
        ->select('obats.*', 'satuans.satuan as satuans', 'kategoris.kategori as kategoris' );
        return $data;
    }
}
