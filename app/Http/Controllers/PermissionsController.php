<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index(PermissionDataTable $dataTable){
        return $dataTable->render('konfigurasi.permissions');
    }
    public function edit($id){
        $permissions = Permission::where('id' ,'=', $id)->first();
        $judul = "Edit Permissions";
        return view('konfigurasi.permission-action', compact(['permissions', 'judul']));
    }
    public function update(Request $request , $id){
        $permissions = Permission::where('id' ,'=', $id)->first();
        $permissions->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        return response()->json([
            'status' => 'succes',
            'massage' => 'Data Berhasil Diubah'
        ]);
    }

    public function create(){
        $judul = "Buat Permissions";
        return view('konfigurasi.permission-action', ['permissions' => new Permission(), 'judul' => $judul]);
    }
    public function store(Request $request){
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        return response()->json([
            'status' => 'succes',
            'massage' => 'Data Berhasil Ditambah'
        ]);
    }
    public function delete($id){
        $permissions = Permission::where('id' ,'=', $id)->first();
        $permissions->delete();
        return response()->json([
            'status' => 'succes',
            'massage' => 'Data Berhasil Dihapus'
        ]);
    }
}
