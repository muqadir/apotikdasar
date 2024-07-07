<?php

namespace App\Http\Controllers;


use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index() {
        $data = Supplier::all();
        if(request()->ajax()){
            return datatables()->of($data)
            ->addColumn('aksi', function($data){
                $button = '<button class="edit btn btn-warning" id="'. $data->id.'" name="edit"> Edit</button>';
                $button .= '<button class="hapus btn btn-danger" id="'. $data->id.'" name="hapus">Del</button>';
                return $button;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('supplier.dashboard');
    }

    public function store(Request $request) {
        $rules = [
            'name'  => 'required',
            'telp'  => 'required|max:12|unique:suppliers,telp',
            'email' => 'required|unique:suppliers,email',
            'rekening' => 'required|max:12|unique:suppliers,rekening',
            'alamat' => 'required',

        ];

        $text = [
            'name.required'     => 'Kolom Nama tidak boleh kosong',
            'telp.required'     => 'Kolom Telepon tidak boleh kosong',
            'telp.unique'       => 'Nomor Telepon sudah terdaftar',
            'telp.max'          => 'Nomor Telepon maksimal 12 digit',
            'email.required'    => 'Kolom Email tidak boleh kosong',
            'email.email'       => 'Format Email tidak valid',
            'email.unique'      => 'Email sudah terdaftar',
            'rekening.required' => 'Kolom Rekening tidak boleh kosong',
            'rekening.unique'   => 'Rekening sudah terdaftar',
            'rekening.max'      => 'Nomor Rekening maksimal 12 digit',
            'alamat.required'   => 'Kolom Alamat tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }

        $data = new Supplier();
        $data->name = $request->name;
        $data->telp = $request->telp;
        $data->email = $request->email;
        $data->rekening = $request->rekening;
        $data->alamat = $request->alamat;
        $save = $data->save();

        if ($save) {
            return response()->json(['text' => 'Data Supplier berhasil disimpan'], 200);
        } else {
            return response()->json(['text' => 'Data Supplier gagal disimpan'], 422);
        }
    }
    public function edits(Request $request) {
        $data = Supplier::find($request->id);
        return response()->json($data);
    }
    public function updates(Request $request) {
        // dd($request->all());
        $data = Supplier::find($request->id);
        $simpan = $data->update($request->all());
        if($simpan) {
            return response()->json(['text' => 'Data Supplier Berhasil di update'], 200);
        } else {

            return response()->json(['text' => 'Data Supplier Gagal di update'], 400);
        }
    }
    public function destroy(Request $request) {
        // dd($request->all());
        $data = Supplier::find($request->id);
        $hapus = $data->delete();
        if ($hapus) {
            return response()->json(['text' => 'Data Supplier berhasil dihapus'], 200);
        } else {
            return response()->json(['text' => 'Data Supplier gagal dihapus'], 500);
        }
    }
}
