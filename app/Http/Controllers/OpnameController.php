<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Penjualan;
use App\Models\Stockobat;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpnameController extends Controller
{
    public function index() 
    {
        $obat = Obat::joinStock();
        return view('stopopname.index', compact('obat'));
    }

    public function store(Request $request) 
    {
        // dd($request->all());
        $data = [
            'obat_id' => $request->obat_id,
            'stock'   => $request->real,
            'keterangan' => 'Telah Diopnamekan Oleh' . Auth::user()->name. 'Dengan Alasan' . $request->keterangan
        ];

        $stock = Stockobat::where('obat_id', $request->obat_id)->first();
        $opname = $stock->update($data);
        if($opname) {
            return response()->json(['text' => 'Data Stockobat Berhasil di update'], 200);
        } else {

            return response()->json(['text' => 'Data Stockobat Gagal di update'], 400);
        }
    }

    public function DataBeli(Request $request) {
        $obat = Obat::find($request->id);
        if ($obat != null) {
            $beli = Pembayaran::joinBeli()
            ->where('pembelians.item', $obat->name)
            ->get();
        } else {
            $beli = [];
        }
        if(request()->ajax()){
            return datatables()->of($beli)->make(true);
         }
        
    }
    public function DataJual(Request $request) {
        $jual = Penjualan::join()
        ->where('penjualans.item', $request->id)
        ->get();
        if(request()->ajax()){
            return datatables()->of($jual)->make(true);
         }
    }

    public function cekStock(Request $request) {
        $stock = Stockobat::where('obat_id', $request->id)->get();
        return response()->json(['stock' => $stock]);
    }
}
