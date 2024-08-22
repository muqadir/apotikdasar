<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportBelanja;
use App\Exports\ExportPenjualan;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function LapPembayaran(Request $request) 
    {
        $data = [];

       if ($request->pilih == 'jual') {

        $data = [
            'min' => Carbon::parse($request->minp)->startOfDay(),
            'max' => Carbon::parse($request->maxp)->endOfDay(),
        ];
            return Excel::download(new ExportPenjualan($data), 'Penjualan.xlsx');
        } else {
            $data = [
                'min' => Carbon::parse($request->minb)->startOfDay(),
                'max' => Carbon::parse($request->maxb)->endOfDay(),
            ];
            return Excel::download(new ExportBelanja($data), 'Belanja.xlsx');
        }
    }
}

// Carbon::parse($request->minb)->startOfDay()
// Carbon::parse($request->maxb)->endOfDay();