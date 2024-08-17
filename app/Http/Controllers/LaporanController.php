<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Yajra\DataTables\Facades\DataTables;


class LaporanController extends Controller
{
     public  function index() {
        return view('laporan.index');
     }


     public function dataTablePenjualan() 
     {
      $data = Penjualan::join()
      ->groupBy('penjualans.nota')
      ->selectRaw('SUM(penjualans.subtotal) as totals')
      ->selectRaw('SUM(penjualans.diskon) as diskons')
      ->get();
      if(request()->ajax()){
         return datatables()->of($data)
         ->addColumn('aksi', function($data){
            $button = '<button class="detailsjual btn btn-warning" id="'. $data->nota.'" name="detailsjual"> Details</button>';
          
            return $button;
         })
            ->rawColumns(['aksi'])
            ->make(true);
      }
      
     }
     public function dataTablePembelian() 
     {
      $data = Pembelian::join()
         ->groupBy('pembelians.faktur')
         ->select('pembelians.*', 'suppliers.name as supplier', 'users.name as kasir')
         ->selectRaw('SUM(pembelians.totalbersih) as totals')
         ->get();
      if(request()->ajax()){
         return datatables()->of($data)
         ->addColumn('aksi', function($data){
            $button = '<button class="detailsbeli btn btn-warning" id="'. $data->faktur.'" name="detailsbeli"> details</button>';
            return $button;
         })
            ->rawColumns(['aksi'])
            ->make(true);
      }

     }


     public function DetailPenjualan(Request $request)
     {
         $nota = $request->nota;
         $data = Penjualan::join()->where('penjualans.nota', $nota)       
         ->get();
         if(request()->ajax()){
            return datatables()->of($data)->make(true);
         }
     }

     public function DetailPembelian(Request $request)
     {
         $faktur = $request->faktur;
         $data = Pembelian::join()->where('pembelians.faktur', $faktur)
         ->select('pembelians.*', 'suppliers.name as supplier', 'users.name as kasir')
         ->get();
         if(request()->ajax()){
            return datatables()->of($data)->make(true);
         }
     }
}
