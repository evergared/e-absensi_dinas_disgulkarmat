<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    #region user umum
    public function index(Request $r)
    {
        return view('dashboard.main');
    }

    public function tampilAbsensiHarian(Request $r)
    {
        return view('dashboard.histori-absensi-harian-pribadi');
    }

    public function tampilAbsensiApel(Request $r)
    {
        return view('dashboard.histori-absensi-apel-pribadi');
    }
    #endregion

    #region ubah absensi
    public function tampilUbahAbsensiHarian(Request $r)
    {
        return view('dashboard.absensi-harian');
    }

    public function tampilUbahAbsensiApel(Request $r)
    {
        return view('dashboard.absensi-apel');
    }
    #endregion

    #region user pimpinan
    public function tampilPimpinanAbsensiAnggota(Request $r)
    {
        return view('dashboard.pimpinan-absensi-anggota');
    }

    public function tampilPimpinanHistoriAbsensiAnggota(Request $r)
    {
        return view('dashboard.pimpinan-histori-absensi-anggota');
    }
    #endregion

    #region user admin
    public function tampilAdminHistoriAbsensi(Request $r)
    {
        return view('dashboard.admin-histori-absensi');
    }

    public function tampilManagePegawai(Request $r)
    {
        return view('dashboard.admin-manage-kepegawaian');
    }

    public function tampilManageUser(Request $r)
    {
        return view('dashboard.admin-manage-user');
    }
    #endregion

}
