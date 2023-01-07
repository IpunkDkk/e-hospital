<?php

namespace App\Http\Controllers;

use App\Models\RekamMedik;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PasienController extends Controller
{
    public function index(){
        return view('rekam.pasien');
    }
    public function pasiensData(){
        $query = User::role('Pasien')->with('profile');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('opsi', function ($query){
                $opsi = '<a type="button" href="'.url('rekam-medis/pasien/show?id='.$query->kode).'" class="btn btn-primary btn-sm"><i class="ti-eye"></i></a>';
                if(Auth::guard('web')->user()->hasPermissionTo('delete rekam-medis/pasien')){
                    $opsi .= ' <a type="button" data-id='.$query->id.' data-type="delete" class="btn btn-danger btn-sm action"><i class="ti-trash"></i></a>';
                }
                return $opsi;
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }
    public function rekamMedikData($id){
        $query = RekamMedik::where('user_id', $id);
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status', function ($query){
                if ($query->status == 'Masuk'){
                    $status = '<span class="badge bg-primary text-wrap">'.$query->status.'</span>';
                }else{
                    $status = '<span class="badge bg-danger text-wrap">'.$query->status.'</span>';
                }
                return $status;
            })
            ->addColumn('opsi', function ($query){
                $opsi = '<a type="button" href="'.route('pasien.show', $query->id).'" class="btn btn-primary btn-sm"><i class="ti-eye"></i></a>';
                $opsi .= ' <a type="button" data-id='.$query->id.' data-type="delete" class="btn btn-danger btn-sm action"><i class="ti-trash"></i></a>';
                return $opsi;
            })
            ->rawColumns(['opsi', 'status'])
            ->make();
    }
    public function addPasien(){
        $judul = "Tambah Pasien";
        return view('rekam.pasien-action', compact('judul'));
    }
    public function storePasien(Request $request){
        $user = User::create([
            'kode' => $request->kode,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('Pasien');
        $user->profile()->create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'no_kk' => $request->no_kk,
            'photo' => 'avatar1.png'
        ]);

        return response()->json([
            'status' => 'success',
            'massage' => 'Pasien Berhasil Ditamnbahkan',
        ]);
    }
    public function show(Request $request){
        $user = User::where('kode', $request->id)->first();
        return view('rekam.pasien-show', compact('user'));
    }
    public function delete($id){
        $user = User::where('id', $id);
        $user->delete();
        return response()->json([
            'status' => 'Success',
            'massage' => 'Pasien Berhasil Dihapus',
        ]);
    }
    public function addRekamMedik($id){
        $judul = 'Tambah Rekam Medik';
        $role = User::role('Dokter')->get();
        return view('rekam.rekam-medik-action', compact(['judul', 'id', 'role']));
    }
    public function storeRekamMedik(Request $request){
        RekamMedik::create([
            'user_id' => $request->user_id,
            'no-medik' => Str::random('10'),
            'masuk' => $request->masuk,
            'd-utama' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'k-krs' => $request->input('k-krs'),
            'c-krs' => $request->input('c-krs'),
            'c-mrs' => $request->input('c-mrs'),
            'd-merawat' => $request->input('d-merawat'),
        ]);
        return response()->json([
            'status' => 'Success',
            'massage' => 'Rekam Medis Berhasil Ditambah',
        ]);
    }
    public function cariPasien(){
        $judul = "Cari Pasien";
        return view('rekam.pasien-cari', compact('judul'));
    }
    public function redirectPasien(Request $request){
        return redirect()->route('pasien.show', 'id='.$request->kode);
    }
}
