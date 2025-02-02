<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Stockobat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class StockobatController extends Controller
{

    public function index() {
        $obat = Obat::where('ready','N')->get();

        if (Auth::user()->isAbleTo('stock-read')) {
            $stock = Stockobat::join()->get();
        } else {
            abort(403);
        }
        
        if(request()->ajax()){
            return datatables()->of($stock)
            ->addColumn('aksi', function($stock){
                    $button = '<button class="edit btn btn-warning" id="'. $stock->id.'" name="edit"> Edit</button>';
                    $button .= '<button class="hapus btn btn-danger" id="'. $stock->id.'" name="hapus">Del</button>';
                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('stockobat.index', compact('obat'));
    }
    public function store(Request $request) {

        if (Auth::user()->isAbleTo('stock-create')) {
           
            $rules = [
                'obat_id' => 'required|exists:obats,id',
                'masuk' => 'required|integer',
                'keluar' => 'required|integer',
                'jual' => 'required|numeric',
                'beli' => 'required|numeric',
                'expired' => 'required|date',
                'stock' => 'required|integer',
                'keterangan' => 'nullable|string|max:100',
            ];
            
            $text = [
                'obat_id.required' => 'Kolom Obat tidak boleh kosong',
                'obat_id.exists' => 'Obat tidak valid',
                'masuk.required' => 'Kolom Masuk tidak boleh kosong',
                'masuk.integer' => 'Kolom Masuk harus berupa bilangan bulat',
                'keluar.required' => 'Kolom Keluar tidak boleh kosong',
                'keluar.integer' => 'Kolom Keluar harus berupa bilangan bulat',
                'jual.required' => 'Kolom Jual tidak boleh kosong',
                'jual.numeric' => 'Kolom Jual harus berupa angka',
                'beli.required' => 'Kolom Beli tidak boleh kosong',
                'beli.numeric' => 'Kolom Beli harus berupa angka',
                'expired.required' => 'Kolom Expired tidak boleh kosong',
                'expired.date' => 'Kolom Expired harus berupa tanggal yang valid',
                'stock.required' => 'Kolom Stock tidak boleh kosong',
                'stock.integer' => 'Kolom Stock harus berupa bilangan bulat',
                'keterangan.max' => 'Kolom Keterangan tidak boleh lebih dari :max karakter',
            ];
    
            $validator = Validator::make($request->all(), $rules, $text);
            if ($validator->fails()) {
                return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
            }
    
            $data = new Stockobat();
            $data->obat_id = $request->obat_id; 
            $data->masuk = $request->masuk;
            $data->keluar = $request->keluar;
            $data->jual = $request->jual;
            $data->beli = $request->beli;
            $data->expired = $request->expired; 
            $data->stock = $request->stock;
            $data->keterangan = $request->keterangan; 
            $data->user_id = Auth::user()->id;
            $save = $data->save();
    
            if ($save) {
                DB::table('obats')->where('id', $request->obat_id)->update(['ready' => 'Y']);
                return response()->json(['text' => 'Data Stockobat berhasil disimpan'], 200);
            } else {
                return response()->json(['text' => 'Data Stockobat gagal disimpan'], 422);
            }
        } else {
            abort(403);
        }

    }
    public function getObat(Request $request) 
    {
        if (Auth::user()->isAbleTo('stock-read')) {
            $data = Stockobat::find('obat_id',$request->id)>first();
            $null = [
                'stock' => 0
            ];
    
            if ($data != null) {
                return response()->json(['data' => $data]); 
            } else {
                return response()->json(['data' => $null]);
            }
        } else {
            abort(403);
        }
    }
    public function edits(Request $request) 
    {
        if (Auth::user()->isAbleTo('stock-read')) {
            $data = Stockobat::find($request->id);
            return response()->json($data);  
        } else {
            abort(403);
        }
    }
    public function updates(Request $request) 
    {
        if (Auth::user()->isAbleTo('stock-update|stock-read')) {
            $data = Stockobat::find($request->id);
            $simpan = $data->update($request->all());
            if($simpan) {
                return response()->json(['text' => 'Data Stockobat Berhasil di update'], 200);
            } else {
    
                return response()->json(['text' => 'Data Stockobat Gagal di update'], 400);
            }
           
        } else {
            abort(403);
        }
    }

    public function destroy(Request $request) 
    {
        if (Auth::user()->isAbleTo('stock-read|stock-delete')) {
            $data = Stockobat::find($request->id);
            $hapus = $data->delete();
            if ($hapus) {
                return response()->json(['text' => 'Data Stockobat berhasil dihapus'], 200);
            } else {
                return response()->json(['text' => 'Data Stockobat gagal dihapus'], 500);
            }   
        } else {
            abort(403);
        }
    }

    private function data( array $data) 
    {
        $data = [
            'obat_id' => $data['obat_id'], 
            'masuk' => $data['masuk'],
            'keluar' => $data['keluar'],
            'jual' => $data['jual;'],        
            'beli' => $data['beli;'],        
            'expired' => $data['expired'], 
            'stock' => $data['stock'],
            'keterangan' => $data['keterangan'], 
            'user_id ' => Auth::user()->id,
        ];
     }

     public function getDataObat(Request $request) {
        if (Auth::user()->isAbleTo('stock-read')) {
            $data = Stockobat::where('obat_id', $request->id)->first();
            return response()->json($data);
        }  else {
        abort(403);
        }
     }
     
}
