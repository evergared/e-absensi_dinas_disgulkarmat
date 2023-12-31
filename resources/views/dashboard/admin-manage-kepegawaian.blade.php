@extends('layouts.sb-admin_dashboard-frame',['dashboard_title' => 'Manage Kepegawaian'])

@section('content')
            
            <div class="card">
                <div class="card-header">
                    <h2>Manage Pegawai</h2>
                </div>
                <div class="card-body overflow-auto">
                    <table id="table-pegawai" class="table table-bordered"></table>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" onclick="test()">Klik Test</button>
                </div>
            </div>
@endsection

@push('stack-head')
{{-- datatable --}}
{{-- sumber : https://datatables.net/download/ --}}
    <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/datatables.min.js"></script>
@endpush

@push('stack-body')
    <script type="text/javascript">
        // $(document).ready(function () {
                var tabel = $('#table-pegawai').DataTable({
                    processing : true,
                    serverSide : true,
                    ajax : {
                        url : "/pegawai",
                    },
                    columns : [
                        {data : "nrk", title : "NRK"},
                        {data : 'nip', title : "NIP"},
                        {data : 'nama', title : "Nama"}
                    ],
                });

                
            // });

            function test()
                {
                    console.log("tombol test di klik")
                    tabel.ajax.url("/pegawai?penempatan=tempat02")
                    tabel.ajax.reload()
                }
    </script>
@endpush
