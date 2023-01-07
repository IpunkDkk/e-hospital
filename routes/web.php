<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HandleIot;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function (){
    Route::get('/', [LoginController::class, 'index'] )->name('login');
    Route::post('/', [LoginController::class, 'login'])->name('login');
});
Route::middleware('auth')->group(function (){
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function ($r){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('iot', [HandleIot::class, 'receive']);
Route::get('test', function (){
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'can:read konfigurasi'],  'prefix' => 'konfigurasi'], function ($r){
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.index');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{id}', [RoleController::class, 'delete'])->name('roles.delete');

    Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('permissions/create', [PermissionsController::class, 'create'])->name('permissions.index');
    Route::post('permissions/store', [PermissionsController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [PermissionsController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/{id}', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/{id}', [PermissionsController::class, 'delete'])->name('permissions.delete');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::delete('users/{id}', [UserController::class, 'delete'])->name('users.delete');
});

Route::group(['middleware' => ['auth', 'can:read rekam-medis'] , 'prefix' => 'rekam-medis' ], function (){
    Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('pasien/show', [PasienController::class, 'show'])->name('pasien.show');
    Route::delete('pasien/delete/{id}', [PasienController::class, 'delete'])->name('pasien.delete');
    Route::get('pasien/pasien', [PasienController::class, 'pasiensData'])->name('pasien.data');
    Route::get('pasien/medik/{id}', [PasienController::class, 'rekamMedikData'])->name('rekam.data');
    Route::get('pasien/create', [PasienController::class, 'addPasien'])->name('pasien.create');
    Route::post('pasien/create', [PasienController::class, 'storePasien'])->name('pasien.store');
    Route::get('pasien/cari', [PasienController::class, 'cariPasien'])->name('pasien.cari');
    Route::post('pasien/cari', [PasienController::class, 'redirectPasien'])->name('pasien.cari');
    Route::get('pasien/rekam-medik/create/{id}', [PasienController::class, 'addRekamMedik'])->name('rekam.create');
    Route::post('pasien/rekam-medik/create', [PasienController::class, 'storeRekamMedik'])->name('rekam.create');
});
