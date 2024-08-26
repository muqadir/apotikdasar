<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index() {
        $satuan = Satuan::select('id', 'satuan')->get();
        $kategori = Kategori::select('id', 'kategori')->get();
        $data = Obat::join()->get();
        if(request()->ajax()){
            return datatables()->of($data)
            ->addColumn('aksi', function($data){

                if (Auth::user()->hasRole('gudang')) {
                    $button = '';
                } else {
                    
                    $button = '<button class="edit btn btn-warning" id="'. $data->id.'" name="edit"> Edit</button>';
                    $button .= '<button class="hapus btn btn-danger" id="'. $data->id.'" name="hapus">Del</button>';
                }
                
                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('obat.index', compact('satuan', 'kategori'));
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required|max:25',
            'kode' => 'required|max:8|unique:obats',
            'dosis' => 'required|max:20',
            'indikasi' => 'required|max:50',
            'kategori_id' => 'required|exists:kategoris,id',
            'satuan_id' => 'required|exists:satuans,id',

        ];

        $text = [
            'name.required'     => 'Kolom Nama Obat tidak boleh kosong',
            'name.max'          => 'Kolom Nama Obat maksimal 25 karakter',
            'kode.required'     => 'Kolom Kode Obat tidak boleh kosong',
            'kode.max'          => 'Kolom Kode Obat maksimal 8 karakter',
            'kode.unique'       => 'Kode Obat sudah digunakan, silakan pilih kode lain',
            'dosis.required'    => 'Kolom Dosis tidak boleh kosong',
            'dosis.max'         => 'Kolom Dosis maksimal 20 karakter',
            'indikasi.required' => 'Kolom Indikasi tidak boleh kosong',
            'indikasi.max'      => 'Kolom Indikasi maksimal 50 karakter',
            'kategori_id.required' => 'Kolom Kategori Obat tidak boleh kosong',
            'kategori_id.exists'   => 'Kategori Obat tidak valid',
            'satuan_id.required'   => 'Kolom Satuan Obat tidak boleh kosong',
            'satuan_id.exists'     => 'Satuan Obat tidak valid',
        ];

        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }

        $data = new Obat();
        $data->name = $request->name;
        $data->kode = $request->kode;
        $data->dosis = $request->dosis;
        $data->indikasi = $request->indikasi;
        $data->kategori_id = $request->kategori_id;
        $data->satuan_id = $request->satuan_id;
        $save = $data->save();

        if ($save) {
            return response()->json(['text' => 'Data Obat berhasil disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Obat gagal disimpan'], 422);
        }
    }
    public function edits(Request $request) {
        $data = Obat::find($request->id);
        return response()->json($data);
    }
    public function updates(Request $request) {
        $data = Obat::find($request->id);
        $simpan = $data->update($request->all());
        if($simpan) {
            return response()->json(['text' => 'Data Obat Berhasil di update'], 200);
        } else {

            return response()->json(['text' => 'Data Obat Gagal di update'], 400);
        }
    }
    public function destroy(Request $request) {
        $data = Obat::find($request->id);
        $hapus = $data->delete();
        if ($hapus) {
            return response()->json(['text' => 'Data Obat berhasil dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Obat gagal dihapus'], 500);
        }
    }

    public function cariKode(Request $request)
    {
        $kode = $request->kode;
        $data = Obat::where('id', $kode)->get();
        return response()->json($data, 200);
    }
}
