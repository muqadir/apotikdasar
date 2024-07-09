<?php

namespace App\Models;

use App\Models\Obat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stockobat extends Model
{
    use HasFactory;
    protected $fillable = [
        'obat_id',
        'masuk',
        'keluar',
        'jual',
        'beli',
        'expired',
        'stock',
        'keterangan',
        'user_id',
    ];
    public static function join() 
    {
        $data = DB::table('stockobats')
        ->join('obats',  'stockobats.obat_id', 'obats.id')
        ->join('users',  'stockobats.user_id', 'users.id')
        ->select('stockobats.*', 'obats.name as namaobat', 'users.name as admin');
        return $data;
    }
    // Define relationships
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function obat()
    // {
    //     return $this->belongsTo(Obat::class);
    // }
}
