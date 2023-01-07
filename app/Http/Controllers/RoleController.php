<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index (RoleDataTable $dataTable) {
        return $dataTable->render('konfigurasi.role');
    }
    public function edit($id){
        $role = Role::where('id', '=', $id)->first();
        $judul = "Edit Role";
        $permissions = Permission::all();
        return view('konfigurasi.role-action', compact(['role', 'judul', 'permissions']));
    }
    public function update(Request $request, $id){
        $role = Role::where('id', '=', $id)->first();
        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);
        return response()->json([
            'status' => 'succes',
            'massage' => 'Data Berhasil Diubah'
        ]);
    }
    public function delete($id){
        $role = Role::where('id', '=', $id)->first();
        $role->delete();
        return response()->json([
            'status' => 'succes',
            'massage' => 'Data Berhasil dihapus'
        ]);
    }
    public function create(){
        $judul = "Buat Role";
        $permissions = Permission::all();
        return view('konfigurasi.role-action', ['role' => new Role , 'judul' => $judul, 'permissions' => $permissions]);
    }
    public function store(Request $request){
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name
        ]);
        $role->givePermissionTo($request->permissions);
        return response()->json([
            'status' => 'succes',
            'massage' => 'Data Berhasil ditambah'
        ]);
    }
}
