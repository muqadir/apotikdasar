<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GrahamCambell\ResulType\Result;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response; // Import R

class PembayaranController extends Controller

{
    public function index ()
    {
        // $obat = Obat::select('id','name')->get();
        $pembyr = Pembayaran::all();
        if(request()->ajax()){
            return datatables()->of($pembyr)
            ->addColumn('aksi', function($pembyr){
                $button = '<button class="cetak btn btn-warning" id="'. $pembyr->nota.'" name="cetak"><i class="fas fa-file-pdf mr-2"></i> Cetak </button>';
               
                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('pembayaran.index');

    }

    public function store(Request $request) {
        //  $data = $request->all();

        //  dd($data);
        $rules = [
            'nota' => 'required|string|max:15',
            'totalharga' => 'required|numeric',
            'totaldiskon' => 'required|numeric',
            'totalpajak' => 'required|numeric',
            'harusbayar' => 'required|numeric',
            'jumlahdibayar' => 'required|numeric',
            'kembali' => 'required|numeric',
        ];

        $text = [
            'nota.required' => 'Kolom Nota tidak boleh kosong.',
            'nota.string' => 'Kolom Nota harus berupa teks.',
            'nota.max' => 'Panjang Nota sampai 15 karakter.',
            'totalharga.required' => 'Kolom Total Harga tidak boleh kosong.',
            'totalharga.numeric' => 'Kolom Total Harga harus berupa angka.',
            'totaldiskon.required' => 'Kolom Total Diskon tidak boleh kosong.',
            'totaldiskon.numeric' => 'Kolom Total Diskon harus berupa angka.',
            'harusbayar.required' => 'Kolom Harus Bayar tidak boleh kosong.',
            'harusbayar.numeric' => 'Kolom Harus Bayar harus berupa angka.',
            'jumlahdibayar.required' => 'Kolom Jumlah Dibayar tidak boleh kosong.',
            'jumlahdibayar.numeric' => 'Kolom Jumlah Dibayar harus berupa angka.',
            'kembali.required' => 'Kolom Kembali tidak boleh kosong.',
            'kembali.numeric' => 'Kolom Kembali harus berupa angka.',
        ];

        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }

        $data = new Pembayaran();
        $data->nota = $request->nota;
        $data->totalharga = $request->totalharga;
        $data->totaldiskon = $request->totaldiskon;
        $data->totalpajak = $request->totalpajak;
        $data->harusbayar = $request->harusbayar;
        $data->jumlahdibayar = $request->jumlahdibayar;
        $data->kembali = $request->kembali;
        $data->status = $request->status;
        $save = $data->save();

        if ($save) {
            return response()->json(['text' => 'Data Pembayaran berhasil disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Pembayaran gagal disimpan'], 422);
        }
    }

    public function CetakNota(Request $request)
    {
        $nota = $request->id;    
        $data = Penjualan::JoinCetak()->where('penjualans.nota', $nota)->get();
        $dompdf = new Dompdf();
        $html = view('pembayaran.nota', compact('data','nota'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $nama_file = ''.$nota . '.pdf'; // Misalnya 'nota_12345.pdf'
         file_put_contents(public_path('pdf/' . $nama_file), $output);
        

        return response()->json([
            'message' => 'PDF file generated successfully.',
            'url' => '/pdf/'. $nama_file
        ]);
    }
}