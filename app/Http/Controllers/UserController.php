<?php

namespace App\Http\Controllers;

use App\Models\levelmodel;
use App\Models\usermodel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    //menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar user',
            'list' => ['Home', 'user'],
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; //set menu yang aktif
        $level = levelmodel::all(); //mengambil data level untuk filter level
        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'level'=>$level]);
    }

    public function list(Request $request)
    {
        $user = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        if ($request->level_id){
            $user->where('level_id',$request->level_id);
        }
        return DataTables::of($user)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btnsm">Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home','User','Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah User Baru'
        ];

        $level = levelmodel::all();
        $activeMenu ='user';

        return view('user.create',['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' =>$activeMenu]);
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'=>'required|string|max:100',
            'password'=>'required|min:5',
            'level_id'=>'required|integer',
        ]);

        usermodel::create([
            'username'=>$request->username,
            'nama'=>$request->nama,
            'password'=>bcrypt($request->password),
            'level_id'=> $request->level_id
        ]);

        return redirect('/user')->with('success','Data user berhasil disimpan');
    }

    public function show(string $id){
        $user = usermodel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail user',
            'list' => ['Home','User','Detail']
        ];

        $page = (object)[
            'title'=>'Detail user'
        ];

        $activeMenu = 'user';
        return view('user.show',['breadcrumb' =>$breadcrumb,'page'=>$page,'user'=>$user, 'activeMenu'=>$activeMenu]);
    }

    public function edit(string $id){
        $user = usermodel::find($id);
        $level = levelmodel::all();

        $breadcrumb = (object)[
            'title' =>'Edit user',
            'list'=>['Home','User','Edit']
        ];

        $page = (object)[
            'title'=>'Edit User'
        ];

        $activeMenu = 'user';

        return view('user.edit',['breadcrumb'=> $breadcrumb, 'page'=>$page,'level'=>$level,'activeMenu'=>$activeMenu, 'user'=>$user]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer'
        ]);

        $user = UserModel::find($id);
        
        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'level_id' => $request->level_id
        ]);
        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id){
        $check = usermodel::find($id);
        if(!$check){
            return redirect('/user')->with('error','Data user tidak ditemukan');
        }

        try{
            usermodel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect('/user')->with('error','Data user gagal dhapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax(){
        $level = levelmodel::select('level_id','level_nama')->get();

        return view('user.create_ajax')->with('level',$level);
    }

    public function store_ajax(Request $request){
        if ($request->ajax()||$request->wantsJson()){
            $rules = [
                'level_id'=>'required|integer',
                'username'=>'required|string|min:3|unique:m_user,username',
                'nama' =>'required|string|max:100',
                'password'=>'required|min:6'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return response()->json([
                    'status'=>false,
                    'message'=>'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            usermodel::create($request->all());
            return response()->json([
                'status'=>true,
                'message'=> 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }

}