<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable){
        return $dataTable->render('konfigurasi.user');
    }
    public function create(){
        $judul = "Tambah Pasien";
        $role = Role::all();
        return view('konfigurasi.users-action', compact(['role','judul']));
    }
    public function store(Request $request){
        $user = User::create([
            'kode' => $request->kode,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole($request->role);
        $user->profile()->create([
            'name'=> $request->name,
            'photo'=> 'avatar1.png'
        ]);

        return response()->json([
            'status' => 'success',
            'massage' => 'User Berhasil Ditamnbahkan',
        ]);

    }
    public function delete($id){
        $user = User::where('id', '=', $id)->first();
        $user->delete();
        return response()->json([
            'status' => 'success',
            'massage' => 'User Berhasil Dihapus',
        ]);
    }
}
