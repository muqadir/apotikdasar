<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Stokobat;
use App\Models\Supplier;
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
        $obat = Obat::Select('id', 'kode')->get();
        $supplier = Supplier::All();
        $times = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();
        $thnBln = $now->year . $now->month;
        $cek = Pembelian::count();
        if ($cek == 0) {
            $urut = 100001;
            $nomor = 'FKTR' . $thnBln . $urut;
        } else {
            $ambil = Pembelian::all()->last();
            $urut = (int)substr($ambil->faktur, - 6) + 1;
            $nomor = 'FKTR' . $thnBln . $urut;
        }
        return view('belanja.index', compact('times', 'nomor', 'obat', 'supplier'));
    }
    public function store(Request $request)
    {

        $rules = [
            'faktur' => 'required|string|max:15',
            'tanggal' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            // 'user_id' => 'required|exists:users,id',
            // 'kode' => 'required|string|max:8',
            'item' => 'required|string|max:20',
            'harga' => 'required|numeric|between:0,9999999.99',
            'qty' => 'required|integer|min:1',
            // 'totalkotor' => 'required|numeric|between:0,9999999.99',
            'pajak' => 'required|numeric|between:0,9999999.99',
            'diskon' => 'required|numeric|between:0,9999999.99',
            // 'totalbersih' => 'required|numeric|between:0,9999999.99',
            // 'keterangan' => 'nullable|string|max:150',
        ];
        
        $text = [
            'faktur.required' => 'Kolom Faktur tidak boleh kosong',
            'faktur.string' => 'Kolom Faktur harus berupa string',
            'faktur.max' => 'Kolom Faktur tidak boleh lebih dari :max karakter',
            'tanggal.required' => 'Kolom Tanggal tidak boleh kosong',
            'tanggal.date' => 'Kolom Tanggal harus berupa tanggal yang valid',
            'supplier_id.required' => 'Kolom Supplier tidak boleh kosong',
            'supplier_id.exists' => 'Supplier tidak valid',
            'item.required' => 'Kolom Item tidak boleh kosong',
            'item.string' => 'Kolom Item harus berupa string',
            'item.max' => 'Kolom Item tidak boleh lebih dari :max karakter',
            'harga.required' => 'Kolom Harga tidak boleh kosong',
            'harga.numeric' => 'Kolom Harga harus berupa angka',
            'harga.between' => 'Kolom Harga harus berada dalam rentang 0 sampai 9999999.99',
            'qty.required' => 'Kolom Qty tidak boleh kosong',
            'qty.integer' => 'Kolom Qty harus berupa bilangan bulat',
            'qty.min' => 'Kolom Qty harus minimal 1',
            'pajak.required' => 'Kolom Pajak tidak boleh kosong',
            'pajak.numeric' => 'Kolom Pajak harus berupa angka',
            'pajak.between' => 'Kolom Pajak harus berada dalam rentang 0 sampai 9999999.99',
            'diskon.required' => 'Kolom Diskon tidak boleh kosong',
            'diskon.numeric' => 'Kolom Diskon harus berupa angka',
            'diskon.between' => 'Kolom Diskon harus berada dalam rentang 0 sampai 9999999.99',
        ];
        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }
        // dd($request->all()); 
        // CARA SIMPAN PERTAMA
        $discount = ((int)$request->diskon / 100) * $request->subtotal;
        $pajak = ((int)$request->pajak / 100) * $request->subtotal;
        $bersih = ((int)$request->subtotal + $pajak) - $discount;
       
        $data = new Pembelian();
        $data->faktur = $request->faktur;
        $data->item = $request->item;
        $data->harga = $request->harga;
        $data->qty = $request->qty;
        $data->tanggal = $request->tanggal;
        $data->totalkotor = $request->subtotal;
        $data->pajak = $pajak;
        $data->diskon = $discount;
        $data->totalbersih = $bersih;
        $data->keterangan = $request->keterangan;
        $data->supplier_id = $request->supplier_id;
        $data->user_id = Auth::user()->id;
        $save = $data->save();

        // atau cara ini KEDUA MENGGUNAKAN MODEL
        // $save = Pembelian::simpan($request->all());

        if ($save) {
            return response()->json(['text' => 'Data Obat berhasil disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Obat gagal disimpan'], 422);
        }
    }

    /** */
    public function DataPembelian (Request $request) 
    {
        $faktur = $request->faktur;
        $data = Pembelian::join()
        ->where('pembelians.faktur', $faktur)
        ->select('pembelians.*', 'suppliers.name as supplier', 'users.name as admin')
        ->get();

        if(request()->ajax()){
            if(!empty($data)) {

                return datatables()->of($data)
                ->addColumn('aksi', function($data){
                    $button = '<button class="hapus btn btn-danger" id="'. $data->id .'" name="hapus">Del</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
            } else {
                 // Jika data kosong, kirimkan respons JSON dengan data kosong
                return response()->json([
                    'draw' => request()->input('draw'),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => []
                ]);

            }
        }
        return view('belanja.index'); 
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $data = Pembelian::find($id);
        $hapus = $data->delete();
        if ($hapus) {
            return response()->json(['text' => 'Data Pembelian berhasil dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Pembelian gagal dihapus'], 500);
        }
    }

    public function ProsessPembayaran(Request $request){
        $faktur = $request->id;
        $data = Pembelian::hitung($faktur)
        ->groupBy('faktur')
        ->get();
        return response()->json(['data' => $data], 200, );
    }
}


