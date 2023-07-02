@extends('layouts.sb-admin_dashboard-frame',['dashboard_title' => 'Absensi Anggota'])

@section('content')

                    <h2>Input Absensi Anggota</h2>
                    <small class="text-right">
                        {{today()->format('D, d-M-Y')}}
                    </small>
                    <div class="text-left mt-3 mb-4">
                        <h3><u>Group Piket</u></h3>
                        <h5>Piket Hadir : <u>{{$r_piket}}</u></h5>
                            @if (!is_null($r_cadangan))
                                <h5>Cadangan Piket : <u>{{$r_cadangan}}</u></h5>
                            @endif
                        <h5>Lepas Piket : <u>{{$r_lepas}}</u></h5>
                    </div>

                    @if (session()->has('pesan.success'))
                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                                <i class="fa-solid fa-circle-check"></i>
                                {{session('pesan.success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if (session()->has('pesan.danger'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                {{session('pesan.danger')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('pesan.warning'))
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{session('pesan.warning')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (!$sudah_absen)
                        <div class="card">
                            <div class="card-body overflow-auto">
                                <table id="kendali-absen" class="table table-bordered">
                                    <thead class="text-white" style="background: grey">
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Grup</th>
                                        <th>Status Piket</th>
                                        <th>Keterangan</th>
                                    </thead>
                                    <tbody>
                                        <form action="{{route('absensi.store',["tipe" => "harian", "tanggal" => today()->toDateString()])}}" method="POST" id="form-absensi">
                                            @csrf
                                                @forelse ($list_pegawai as $pegawai)
                                                    <tr>
                                                        <td style="text-overflow: ellpsis; overflow: hidden; max-width: 30%;">{{$pegawai['nama']}}</td>
                                                        <td style="text-overflow: ellipsis; overflow: hidden; max-width: 30%;">{{$pegawai['jabatan']}}</td>
                                                        <td style="max-width: 5%">{{$pegawai['grup']}}<input type="hidden" id="grup" name="grup[{{$pegawai['nip']}}]" value="{{$pegawai['grup']}}"></td>
                                                        <td class="justify-content-center align-middle"><select name="status[{{$pegawai['nip']}}]" id="status">
                                                                <option value="piket hadir" @if($pegawai['grup'] == $r_piket) selected @endif>Piket Hadir</option>
                                                                <option value="cadangan hadir"@if(!is_null($r_cadangan) && $pegawai['grup'] == $r_cadangan) selected @endif>Cadangan</option>
                                                                <option value="piket lepas"@if($pegawai['grup'] == $r_lepas) selected @endif>Piket Lepas</option>
                                                                <option value="tidak hadir">tidak hadir</option>
                                                            </select>
                                                        </td>
                                                        <td class="align-middle"><input type="text" name="keterangan[{{$pegawai['nip']}}]" id="keterangan"></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="5">
                                                            Tidak ada data yang dapat ditampilkan.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                @if ($list_pegawai)
                                    <button class="btn btn-primary" onclick="if(confirm('Submit absensi?')) document.getElementById('form-absensi').submit()">Submit Absensi</button>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="p-lg-5 mb-4 bg-light rounded-3">
                            <div class="container-fluid py-5 text-center">
                                <h4 class="display-5 fw-bold">Absensi hari ini telah di submit!</h4>
                            </div>
                        </div>
                    @endif
                    
                            
@endsection
