<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Stokobat;
use App\Models\Pembelian;
use App\Models\Stockobat;
use Illuminate\Http\Request;
use GrahamCambell\ResulType\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response; 
use Dompdf\Dompdf;
use Dompdf\Options;

class PembelianController extends Controller
{
    public function index () {
        $obat = Obat::joinStock();
        $tanggals = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();
        $thnBln = $now->year . $now->month;
        // $cek = Pembelian::count();
        // if ($cek == 0) {
        //     $urut = 1000001;
        //     $nomor = 'NF' . $thnBln . $urut;
        // } else {
        //     $ambil = Pembelian::all()->last();
        //     $notati    = $ambil->nota;
        //     $urut = (int)substr($notati, - 8) + 1;

        //     $nomor = 'NF' . $thnBln . $urut;
        // }
        return view('belanja.index', compact('tanggals',  'obat'));
    }
}
