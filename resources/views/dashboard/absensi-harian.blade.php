@extends('layouts.sb-admin_dashboard-frame')

@section('content')
            
            <div class="card">
                <div class="card-header">
                    <h2>Ubah Kehadiran Anggota</h2>
                </div>
                <div class="card-body overflow-auto">
                    <table class="table table-bordered">
                        <thead>
                            <th>Nama</th>
                            <th>NRK</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </thead>
                        <tbody>
                            @forelse ($data as $dt)
                                <tr>
                                    <td>{{$dt['nama']}}</td>
                                    <td>{{$dt['nrk']}}</td>
                                    <td><span class="badge badge-sm bg-success">Hadir</span></td>
                                    <td>Tindakan</td>
                                </tr>
                            @empty
                                <div class="jumbotron text-center">
                                    Tidak ada data.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">

                </div>
            </div>
@endsection
