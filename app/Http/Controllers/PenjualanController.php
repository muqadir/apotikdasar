<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Stokobat;
use App\Models\Penjualan;
use App\Models\Stockobat;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use GrahamCambell\ResulType\Result;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response; // Import Response dari Laravel


class PenjualanController extends Controller
{
    public function index() {
        if (Auth::user()->isAbleTo('penjualan-read')) {
            $obat = Obat::joinStock();
            $tanggals = Carbon::now()->format('Y-m-d');
            $now = Carbon::now();
            $thnBln = $now->year . $now->month;
            $cek = Penjualan::count();
            if ($cek == 0) {
                $urut = 1000001;
                $nomor = 'NF' . $thnBln . $urut;
            } else {
                $ambil = Penjualan::all()->last();
                $notati    = $ambil->nota;
                $urut = (int)substr($notati, - 8) + 1;
    
                $nomor = 'NF' . $thnBln . $urut;
            }
            
        } else {
            abort(403);
        }

        // dd($thnBln);
        return view('penjualan.index', compact('tanggals', 'nomor', 'obat'));
    }

    public function store(Request $request) 
    {
        if (Auth::user()->isAbleTo('penjualan-create')) {
            $rules = [
                'name'  => 'required',
                'telp'  => 'required',
                'obat_id' => 'required',
                'qty' => 'required',
                'alamat' => 'required',
    
            ];
    
            $text = [
                'name.required' => 'Kolom Nama tidak boleh kosong',
                'telp.required' => 'Kolom Telepon tidak boleh kosong',
                'obat_id.required' => 'Kolom Obat tidak boleh kosong',
                'qty.required'  => 'Kolom quality tidak boleh kosong',
                'alamat.required' => 'Kolom Alamat tidak boleh kosong',
            ];
    
            $validator = Validator::make($request->all(), $rules, $text);
            if ($validator->fails()) {
                return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
            }
    
          
        $existingPenjualan = Penjualan::where('nota', $request->nota)
        ->where('item', $request->obat_id)
        ->first();
    
            if ($existingPenjualan) {
                // Jika data penjualan sudah ada, perbarui kuantitas dan subtotal
                $existingPenjualan->qty += $request->qty;
                $existingPenjualan->subtotal = $request->harga * $existingPenjualan->qty - $request->diskon;
                $existingPenjualan->save();
    
                // Perbarui stok obat
                $stock = Stockobat::where('obat_id', $request->obat_id)->first();
                $stock->stock -= $request->qty;
                $stock->save();
    
                return response()->json(['text' => 'Data Penjualan berhasil diperbarui'], 200);
            } else {
                // Jika data penjualan belum ada, buat data penjualan baru
                $pasien = [
                    'name' => $request->name,
                    'telp' => $request->telp,
                    'alamat' => $request->alamat,
                    'resep' => $request->resep,
                    'pengirim' => $request->pengirim,
                ];
    
                $costumer = Pasien::create($pasien);
                $idPasein = $costumer->id;
    
                $penjualan = [
                    'nota' => $request->nota,
                    'tanggal' => $request->tanggal,
                    'qty' => $request->qty,
                    'pajak' => $request->pajak,
                    'diskon' => $request->diskon,
                    'item' => $request->obat_id,
                    'subtotal' => $request->total,
                    'user_id' => Auth::user()->id,
                    'pasien_id' => $idPasein,
                ];
    
                $transaksi = Penjualan::create($penjualan);
    
                if ($transaksi) {
                    $stock = Stockobat::where('obat_id', $request->obat_id)->first();
                    $stock->stock -= $request->qty;
                    $stock->save();
    
                    return response()->json(['text' => 'Data Penjualan berhasil ditambahkan'], 200);
                } else {
                    return response()->json(['text' => 'Data Penjualan gagal'], 442);
                }
            }
        } else {
            abort(403);
        }

    }

    public function DataPenjualan (Request $request) 
    {
        if (Auth::user()->isAbleTo('penjualan-read')) {
            $nota = $request->id;
            $data = Penjualan::join()
            ->where('nota', $nota)
            ->get();
    
            if(request()->ajax()){
                return datatables()->of($data)
                ->addColumn('aksi', function($data){
                    $button = '<button class="hapus btn btn-danger" id="'. $data->id.'" name="hapus">Del</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
            }
            return view('penjualan.index');
        } else {
            abort(403);
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::user()->isAbleTo('penjualan-delete')) {
            $id = $request->id;
            $hapusPenjualan = Penjualan::find($id);
    
            if (!$hapusPenjualan)
            {
                return response()->json(['text' => 'Data tidak ditemukan'], 404);
            }
    
            // Mengembalikan stok ke stockobat
            $stock = Stockobat::where('obat_id', $hapusPenjualan->item)->first();
            if (!$stock) {
                return response()->json(['text' => 'Stok tidak ditemukan'], 404);
            }
    
            // Menghitung kembali stok yang harus dikembalikan
            $stock->stock += $hapusPenjualan->qty;
            $stock->save();
    
            // Menghapus item penjualan
            if ($hapusPenjualan->delete()) {
                return response()->json(['text' => 'Data berhasil dikembalikan ke stok'], 200);
            } else {
                return response()->json(['text' => 'Gagal menghapus data'], 400);
            }
        } else {
            abort(403);
        }        
    }


    public function getHitung(Request $request) 
    {
        if (Auth::user()->isAbleTo('penjualan-read')) {
            $id = $request->id;
            $data = Penjualan::hitung($id)->get();
            $datas = Penjualan::where('nota', $id)->get();
            $discount = [];
            foreach ($datas as $key) {
                array_push($discount, ($key->diskon / 100 * $key->subtotal));
            }
    
            $diskon = array_sum($discount);
            $pajaks = [];
            foreach ($datas as $key) {
                array_push($pajaks, ($key->pajak / 100 * $key->subtotal));
            }
    
            $pajak = array_sum($pajaks);
    
            return response()->json(['data' => $data, 'diskon' => $diskon, 'pajak' =>  $pajak ]);
        } else {
            abort(403);
        }

    }

    public function CetakNota(Request $request)
    {
        if (Auth::user()->isAbleTo('penjualan-read')) {
            $nota = $request->kwitansi;    
            $data = Penjualan::JoinCetak()->where('penjualans.nota', $nota)->get();
            $dompdf = new Dompdf();
            $html = view('penjualan.nota', compact('data','nota'))->render();
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
        } else {
            abort(403);
        }

    }   
}
