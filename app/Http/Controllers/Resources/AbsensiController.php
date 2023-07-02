<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $kode_absensi =[
            "piket" => "piket hadir",
            "lepas" => "piket lepas",
            "cadangan" => "cadangan hadir",
            "tidak_hadir" => "tidak hadir",
        ];

        try{
            $absensi = Absensi::query();

            if($r->exists('rekap'))
            {
                $absensi = Absensi::query()
                            ->join('pegawai','absensi.nip','=','pegawai.nip')
                            ->join('penempatan','pegawai.penempatan','=','penempatan.id_penempatan')
                            ->join('jabatan', 'pegawai.jabatan','=','jabatan.id_jabatan');

                $tanggal = $r->input('rekap');
                $kehadiran = $kode_absensi[$r->input('tipe')];

                if($r->ajax())
                {

                    $absensi = $absensi
                                ->where('absensi.tanggal',$tanggal)
                                ->where('absensi.kehadiran',$kehadiran)
                                ->select([
                                        'absensi.nip',
                                        'pegawai.nama',
                                        'penempatan.nama_penempatan as penempatan',
                                        'jabatan.nama_jabatan as jabatan',
                                        'absensi.grup',
                                        'absensi.kehadiran as status',
                                        'absensi.keterangan as keterangan'
                                    ]);
                    

                    return DataTables::eloquent($absensi)->toJson();

                }

                return $absensi->where('absensi.tanggal',$tanggal);
                            
            }
            elseif($r->exists("cek"))
            {
                $respons = [];
                $ada = $absensi->where('tanggal',$r->input("cek"))->exists();
                $respons["ada"] = $ada;

                if($ada && $r->exists("jumlah"))
                {
                    error_log("meminta cek dan jumlah");
                    $respons['piket'] = Absensi::where('tanggal',$r->input("cek"))->where("kehadiran","piket hadir")->count();
                    $respons['lepas'] = Absensi::where('tanggal',$r->input("cek"))->where("kehadiran","piket lepas")->count();
                    $respons['cadangan'] = Absensi::where('tanggal',$r->input("cek"))->where("kehadiran","cadangan hadir")->count();
                    $respons['tdk_hadir'] = Absensi::where('tanggal',$r->input("cek"))->where("kehadiran","tidak hadir")->count();
                }

                return response()->json($respons);
            }

            return $absensi;

        }
        catch(Throwable $e)
        {
            error_log("Absensi Controller error : gagal dalam mengambil data at index() ".$e);
        }
        if($r->ajax())
        {
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // return dd($request->only(['grup', 'status', 'keterangan']));
            if($request->exists('tipe'))
            {
                if($request->input('tipe') == "harian")
                {
                    $tanggal = $request->input('tanggal');
                    $array_status = $request->input('status');
                    $array_keterangan = $request->input('keterangan');
                    $array_grup = $request->input('grup');

                    $jumlah = count($array_status);
                    $berhasil = 0;
                    $gagal = 0;
                    foreach($array_status as $nip => $status)
                    {
                        try{
                                $absensi = new Absensi([
                                    'tanggal' => $tanggal,
                                    'nip' => $nip,
                                    'grup' => $array_grup[$nip],
                                    'kehadiran' => $status,
                                    'keterangan' => $array_keterangan[$nip]
                                ]);
                                $absensi->save();
                                $berhasil++;
                            }
                            catch(Throwable $e)
                            {
                                $gagal++;
                                error_log("gagal insert absensi ".$nip." alasan : ".$e);
                            }
                    }
                    
                    if($jumlah == $berhasil)
                        return redirect()->back()->with('pesan.success',"Data absensi berhasil di submit !");
                    elseif($gagal > 0 && $berhasil > 0)
                        return redirect()->back()->with('pesan.success',"Data absensi berhasil di submit !");
                    elseif($jumlah == $gagal)
                        return redirect()->back()->withInput()->with('pesan.danger','Data absensi gagal di submit!');
                    else
                        return redirect()->back()->withInput()->with('pesan.warning','Terjadi kesalahan dalam submit absensi, silahkan coba kembali');

                }
            }

        }
        catch(Throwable $e)
        {
            error_log("Absensi Controller error : Gagal dalam melakukan proses penyimpanan at store() ".$e);
            return redirect()->back()->withInput()->with('pesan.warning','Terjadi kesalahan dalam submit absensi, silahkan coba kembali');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $tanggal
     * @return \Illuminate\Http\Response
     */
    public function show($tanggal)
    {
        try{
            $absen = Absensi::query()->where('tanggal',$tanggal);

            return json_encode([
                "piket" => $absen->where('kehadiran',"piket hadir")->count(),
                "cadangan" => $absen->where("kehadiran","cadangan hadir")->count(),
                "lepas" => $absen->where("kehadiran","piket lepas")->count(),
                "tidak_hadir" => $absen->where("kehadiran","tidak hadir")->count()
            ]);
        }
        catch(Throwable $e)
        {
            error_log("Absensi Controller error : kesalahan saat fetch data dari database untuk tanggal ".$tanggal." at show() ".$e);
            return null;
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
