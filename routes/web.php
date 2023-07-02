<?php

use App\Http\Controllers\Resources\AbsensiController;
use App\Http\Controllers\Resources\PegawaiController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

#region dashboard
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/histori/absensi-harian-saya', [App\Http\Controllers\DashboardController::class, 'tampilAbsensiHarian'])->name('absensi-harian-pribadi');
Route::get('/histori/absensi-apel-saya', [App\Http\Controllers\DashboardController::class, 'tampilAbsensiApel'])->name('absensi-apel-pribadi');
Route::get('/absensi-harian', [App\Http\Controllers\DashboardController::class, 'tampilUbahAbsensiHarian'])->name('absensi-harian');
Route::get('/absensi-apel', [App\Http\Controllers\DashboardController::class, 'tampilUbahAbsensiApel'])->name('absensi-apel');
Route::get('/absensi-anggota', [App\Http\Controllers\DashboardController::class, 'tampilPimpinanAbsensiAnggota'])->name('absensi-anggota');
Route::get('/histori/absensi-anggota', [App\Http\Controllers\DashboardController::class, 'tampilPimpinanHistoriAbsensiAnggota'])->name('histori-absensi-anggota');
Route::get('/admin/data-absensi', [App\Http\Controllers\DashboardController::class, 'tampilAdminHistoriAbsensi'])->name('data-absensi');
Route::get('/admin/manage-pegawai', [App\Http\Controllers\DashboardController::class, 'tampilManagePegawai'])->name('manage-pegawai');
Route::get('/admin/manage-user', [App\Http\Controllers\DashboardController::class, 'tampilManageUser'])->name('manage-user');
#endregion

#region kalender
Route::get('/kalender/libur',[\App\Http\Controllers\CalendarController::class,'indexLibur'])->name("kalender.libur");
Route::get('/kalender/regupiket',[\App\Http\Controllers\CalendarController::class,'indexPiketGrup'])->name("kalender.regu.piket");
#endregion

#region jadwal piket grup/regu
Route::get('/piket/regu',[\App\Http\Controllers\GrupPiketController::class,'index'])->name('piket.regu');
#endregion

#region resources
Route::resource('pegawai',PegawaiController::class);
Route::resource('absensi',AbsensiController::class);
#endregion