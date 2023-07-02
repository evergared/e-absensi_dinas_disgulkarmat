<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JadwalPiketGrup;
use App\Models\Pegawai;
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
        $data = Pegawai::all();
        return view('dashboard.absensi-harian')->with('data',$data);
    }

    public function tampilUbahAbsensiApel(Request $r)
    {
        return view('dashboard.absensi-apel');
    }
    #endregion

    #region user pimpinan
    public function tampilPimpinanAbsensiAnggota(Request $r)
    {
        $hr_ini = today()->toDateString();
        $piket = JadwalPiketGrup::where('tanggal','=',$hr_ini)->where("jadwal",'piket')->first();
        $lepas = JadwalPiketGrup::where('tanggal','=',$hr_ini)->where("jadwal",'lepas')->first();
        $cadangan = JadwalPiketGrup::where('tanggal','=',$hr_ini)->where("jadwal",'cadangan')->first();

        error_log('piket : '.$piket);
        error_log('lepas : '.$lepas);
        error_log('cadangan : '.$cadangan);

        $list_pegawai = [];
        $pernah_absen = Absensi::where("tanggal",$hr_ini)->exists();

        if(!is_null($piket))
        {
            $piket = $piket->grup;
            if(!$pernah_absen)
                foreach(Pegawai::where("grup",$piket)->get()->toArray() as $pegawai)
                    $list_pegawai[] = $pegawai;
        }
        if(!is_null($cadangan))
        {
            $cadangan = $cadangan->grup;
            if(!$pernah_absen)
                foreach(Pegawai::where("grup",$cadangan)->get()->toArray() as $pegawai)
                    $list_pegawai[] = $pegawai;
        }
        if(!is_null($lepas))
        {
            $lepas = $lepas->grup;
            if(!$pernah_absen)
                foreach(Pegawai::where("grup",$lepas)->get()->toArray() as $pegawai)
                    $list_pegawai[] = $pegawai;
        }
        


        return view('dashboard.pimpinan-absensi-anggota')->with([
            'r_piket' => $piket,
            'r_cadangan' => $cadangan,
            'r_lepas' => $lepas,
            'list_pegawai' => $list_pegawai,
            'sudah_absen' => $pernah_absen
        ]);
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
