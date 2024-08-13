<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nota', 'totalharga', 'totaldiskon', 'totalpajak', 'harusbayar', 'jumlahdibayar', 'kembali', 'status'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'nota', 'nota');
    }
}
