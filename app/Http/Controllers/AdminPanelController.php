<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminPanelController extends Controller
{
    public function index()
    {
        $permission = Permission::all();
        $roles =  Role::all();
        $user = User::all();
        if (request()->ajax()) {
            return datatables()->of($user)
                ->addColumn('aksi', function ($user) {
                    $button = '<button class="info btn btn-warning" id="' . $user->id . '" name="info" data-toggle="modal" data-target="#modal-info">Info</button>';
                    $button .= '<button class="hapusUser btn btn-danger" id="' . $user->id . '" name="hapusUser" >Hapus</button>';
                    return  $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('superadmin.panel.index', compact('user', 'permission', 'roles'));
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|max:15',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ];

        $text = [
            'username.required' => 'Kolom username Tidak boleh Kosong',
            'username.max' => 'Inputan maksimum 8 digit',
            'email.required' => 'Kolom email Tidak boleh Kosong',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Kolom password Tidak boleh Kosong',
            'role.required' => 'Role harus dipilih',
        ];

        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }
        $data = new User();
        $data->name = $request->username;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $save = $data->save();

        if ($save) {
            $data->attachRole($request->role);
            return response()->json(['text' => 'User berhasil disimpan'], 200);
        } else {
            return response()->json(['text' => 'User gagal disimpan'], 422);
        }
    }


    public function hapusUser(Request $request)
    {
        $id = $request->id;
        $hapus = User::find($id)->delete();
        if ($hapus) {
            return response()->json(['text' => 'User berhasil dihapus'], 200);
        } else {
            return response()->json(['text' => 'User gagal dihapus'], 500);
        }
    }

    public function getRole(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $role = Role::all();
        $permit = [];

        foreach ($user->roles as $role) {
            $roles = $role->display_name;
            foreach ($role->permissions as $key) {
                array_push($permit, $key);
            }
        }
        return response()->json(['user' => $user, 'roles' => $roles, 'permit' => $permit]);
    }


    public function update(Request $request)
    {
        $rules = [
            'username' => 'required|max:15',
            'role' => 'required',
        ];

        $text = [
            'username.required' => 'Kolom username Tidak boleh Kosong',
            'role.required' => 'Role harus dipilih',
        ];

        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }

        $data = [
            'name' => $request->username,
            'email' => $request->email,
        ];
        $user = User::find($request->id);
        $save = $user->update($data);
        if ($save) {
            $user->syncRoles(explode(',', $request->role));
            return response()->json(['text' => 'Berhasil dibuat']);
        }
    }


    public function LoadPermission()
    {
        $permission = Permission::all();
        if (request()->ajax()) {
            return datatables()->of($permission)
                ->addColumn('aksi', function ($permission) {

                    $button = '<button class="infoPermission btn btn-warning" id="' . $permission->id . '" name="infoPermission" >Info</button>';
                    // $button .='<button class="hapusPermission btn btn-danger" id="'.$permission->id.'" name="hapusPermission" >Hapus</button>';
                    return  $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }



    public function simpanpermission(Request $request)
    {
        $rules = [
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required',
            'hakAkses' => 'required',
        ];

        $text = [
            'name.required' => 'Kolom username Tidak boleh Kosong',
            'display_name.required' => 'Kolom display name Tidak boleh Kosong',
            'description.required' => 'Kolom description Tidak boleh Kosong',
            'hakAkses.required' => 'Permission harus dipilih',
        ];

        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }

        if ($request->hakAkses >= 1) {
            foreach ($request->hakAkses as $key) {
                $data = new Permission();
                $data->name = $request->name . '-' . $key;
                $data->display_name = $key . ' ' . $request->display_name;
                $data->description = $key . ' ' . $request->description;
                $save = $data->save();
            }
            if ($save) {
                return response()->json(['text' => 'Sukses']);
            } else {
                return response()->json(['text' => 'Gagal']);
            }
        }
    }

    public function LoadRole()
    {
        $role = Role::all();
        if (request()->ajax()) {
            return datatables()->of($role)
                ->addColumn('aksi', function ($role) {
                    $button = '<button class="infoRole btn btn-warning" id="' . $role->id . '" name="infoRole" >Info</button>';
                    return  $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function simpanRole(Request $request)
    {
        $rules = [
            'nameRole' => 'required',
            'display_nameRole' => 'required',
            'descriptionRole' => 'required',
            'roleAkses' => 'required',
        ];

        $text = [
            'nameRole.required' => 'Kolom nama Tidak boleh Kosong',
            'display_nameRole.required' => 'Kolom display  Tidak boleh Kosong',
            'descriptionRole.required' => 'Kolom description Tidak boleh Kosong',
            'roleAkses.required' => 'Role Akses harus di ceklis',
        ];

        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }

        $data = new Role();
        $data->name = $request->nameRole;
        $data->display_name = $request->display_nameRole;
        $data->description = $request->descriptionRole;
        $save = $data->save();

        $idRole = $data->id;
        if ($save) {
            for ($i = 0; $i < count($request->roleAkses); $i++) {
                $data->attachPermission($request->roleAkses[$i]);
            }
            return response()->json(['text' => 'Berhasil menambahkan Role']);
        } else {
            $hapus = Role::find($idRole);
            $hapus->delete();
            return response()->json(['text' => 'Gagal menambahkan Role']);
        }
    }

    public function roleInfo(Request $request)
    {
        $id = $request->id;
        $role = Role::find($id);
        $permission = Permission::all();

        $keys = [];
        foreach ($role->permissions as $key) {
            array_push($keys, $key); //kita masukkan data kedalam array keys
        }
        return response()->json(['role' => $role, 'permission' => $keys, 'cek' => $permission]);
    }


    public function roleEdit(Request $request)
    {
        $rules = [
            'nameRole' => 'required',
            'display_nameRole' => 'required',
            'descriptionRole' => 'required',
            'roleAkses' => 'required',
        ];

        $text = [
            'nameRole.required' => 'Kolom nama Tidak boleh Kosong',
            'display_nameRole.required' => 'Kolom display  Tidak boleh Kosong',
            'descriptionRole.required' => 'Kolom description Tidak boleh Kosong',
            'roleAkses.required' => 'Role Akses harus di ceklis',
        ];

        $validator = Validator::make($request->all(), $rules, $text);
        if ($validator->fails()) {
            return response()->json(['success' => 0, 'text' =>  $validator->errors()->first()], 422);
        }
        $data = [
            'name' => $request->nameRole,
            'display_name' => $request->display_nameRole,
            'description' => $request->descriptionRole
        ];

        $id = $request->idRole;
        $role = Role::find($id);

        $edit = $role->update($data);

        if ($edit) {
            $role->syncPermissions($request->roleAkses);
            return response()->json(['text' => '  Role Berhasil Diubah']);
        } else {

            return response()->json(['text' => 'Role Gagal diubah']);
        }
    }
}
