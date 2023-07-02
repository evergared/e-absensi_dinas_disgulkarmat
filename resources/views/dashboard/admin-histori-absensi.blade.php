@extends('layouts.sb-admin_dashboard-frame',['dashboard_title' => 'Rekap Absensi'])

@section('content')
                    <div class="row  mx-2 my-2">
                            <div class="spinner-border text-info" role="status" id="spinner" style="visibility: hidden">
                                <span class="visually-hidden">Memuat....</span>
                            </div>
                            <small>Pilih tanggal untuk memuat absensi.</small>
                            <div class="col-lg-4 material-theme" id="kalender-histori" ></div>
                                
                            <div id="card-listing" class="card d-flex flex-wrap col-lg-6 my-2 mx-auto">
                                <div class="card-header">
                                    <h6>Data Absensi <u id="underline-tanggal"></u></h6>
                                    {{-- <small><i>klik angka dibawah untuk inisiasi tabel</i></small> --}}
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-none d-sm-block">
                                        <div class="row">
                                            <div class="col my-5" id="text-piket">
                                                <h5>Jumlah Hadir Piket : <a id="link-piket" style="cursor: pointer;" onclick="panggilTabel('piket')"></a> </h5>
                                            </div>
                                            <div class="col my-5" id="text-lepas">
                                                <h5>Jumlah Lepas Piket : <a id="link-lepas" style="cursor: pointer;" onclick="panggilTabel('lepas')"></a> </h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col my-5">
                                                <h5>Jumlah Izin/Sakit/dll : <a id="link-tidak-hadir" style="cursor: pointer;" onclick="panggilTabel('tidak_hadir')"></a> </h5>
                                            </div>
                                            <div class="col my-5" id="text-cadangan" style="visibility: hidden">
                                                <h5>Jumlah Hadir Cadangan : <a id="link-cadangan" style="cursor: pointer;" onclick="panggilTabel('cadangan')"></a> </h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-block d-sm-none">
                                        <small id="text-tanggal-m"></small>
                                            <div class="row my-4" id="text-piket">
                                                <h5>Jumlah Hadir Piket : <a id="link-piket-m" style="cursor: pointer;" onclick="panggilTabel('piket')"></a> </h5>
                                            </div>
                                            <div class="row my-4" id="text-lepas">
                                                <h5>Jumlah Lepas Piket : <a id="link-lepas-m" style="cursor: pointer;" onclick="panggilTabel('lepas')"></a> </h5>
                                            </div>
                                            <div class="row my-4">
                                                <h5>Jumlah Izin/Sakit/dll : <a id="link-tidak-hadir-m" style="cursor: pointer;" onclick="panggilTabel('tidak_hadir')"></a> </h5>
                                            </div>
                                            <div class="row my-4" id="text-cadangan-m" style="visibility: hidden">
                                                <h5>Jumlah Hadir Cadangan : <a id="link-cadangan-m" style="cursor: pointer;" onclick="panggilTabel('cadangan')"></a> </h5>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>

            

            <div id="card-tabel" class="card mx-auto p-2 overflow-auto"  style="max-width: 1600px">
                <table id="tabel" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Penempatan</th>
                            <th>Grup</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                </table>
            </div>
@endsection

{{-- start Untuk Kalender --}}
@push('stack-head')
<!-- jsCalendar v1.4.3 Javascript and CSS from jsdelivr npm cdn -->
<script src="https://cdn.jsdelivr.net/npm/simple-jscalendar@1.4.3/source/jsCalendar.min.js" integrity="sha384-JqNLUzAxpw7zEu6rKS/TNPZ5ayCWPUY601zaig7cUEVfL+pBoLcDiIEkWHjl07Ot" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-jscalendar@1.4.3/source/jsCalendar.min.css" integrity="sha384-+OB2CadpqXIt7AheMhNaVI99xKH8j8b+bHC8P5m2tkpFopGBklD3IRvYjPekeWIJ" crossorigin="anonymous">
@endpush

@push('stack-body')
    <script type="text/javascript">

        var spinner = document.getElementById("spinner");
    
        var kalender =
        jsCalendar.new({
            target : document.getElementById("kalender-histori"),
            navigator : true,
            navigatorPosition : "both",
            zeroFill : false,
            monthFormat : "month YYYY",
            dayFormat : "DDD",
            language : "id"
        });

        kalender.onDateClick(function(event,date){
            spinner.style.visibility = "visible"
            const bulan = ['01','02','03','04','05','06','07','08','09','10','11','12'];
            var y = date.getFullYear().toString();
            var m = bulan[date.getMonth()];
            var d = ('0' + date.getDate().toString()).slice(-2);

            var tanggal = y+'-'+m+'-'+d;

            $.ajax({
               type:'GET',
               url:'/absensi?cek='+tanggal+"&jumlah="+true,
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                    if(data.ada)
                    {
                        document.getElementById("underline-tanggal").innerHTML = tanggal;

                        document.getElementById('link-piket').innerHTML = data.piket;
                        document.getElementById('link-cadangan').innerHTML = data.cadangan;
                        document.getElementById('link-lepas').innerHTML = data.lepas;
                        document.getElementById('link-tidak-hadir').innerHTML = data.tdk_hadir;

                        document.getElementById('link-piket-m').innerHTML = data.piket;
                        document.getElementById('link-cadangan-m').innerHTML = data.cadangan;
                        document.getElementById('link-lepas-m').innerHTML = data.lepas;
                        document.getElementById('link-tidak-hadir-m').innerHTML = data.tdk_hadir;

                        if(data.cadangan > 0)
                        {

                        document.getElementById('text-cadangan').visibility = "visible";
                        document.getElementById('text-cadangan-m').visibility = "visible";
                        }
                        else
                        {

                        document.getElementById('text-cadangan').visibility = "hidden";
                        document.getElementById('text-cadangan-m').visibility = "hidden";
                        }

                    }

                    spinner.style.visibility = "hidden"
                    
               }
            });

            kalender.clearselect();
            kalender.select(date);
        });

        

        kalender.onDateRender(function(date, element, info) {
		// Make weekends bold and red
        console.log("date render")
		if (!info.isCurrent && (date.getDay() == 0 || date.getDay() == 6)) {
			element.style.fontWeight = 'bold';
			element.style.color = (info.isCurrentMonth) ? '#c32525' : '#ffb4b4';
		}
	    });
        
        kalender.refresh();
      

        
        
    </script>
@endpush
{{-- end Untuk Kalender --}}


{{-- start Untuk datatable --}}
@push('stack-head')
{{-- datatable --}}
{{-- sumber : https://datatables.net/download/ --}}
    <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/datatables.min.js"></script>
@endpush

@push('stack-body')
    <script>
        var tabel = initTabelKosong()

        function panggilTabel(tipe){
            
            tabel.destroy();    
                var tanggal = document.getElementById("underline-tanggal").innerHTML;
                var ajax_url = '/absensi?rekap='+tanggal+'&tipe='+tipe;
                tabel = $('#tabel').DataTable({
                            processing : true,
                            serverSide : true,
                            ajax : {
                                url : ajax_url
                            },
                            dom: 'Bfrtip',
                            buttons :[
                                'excelHtml5',
                                'csvHtml5',
                                'pdfHtml5'
                            ],
                            columns : [
                                {data : 'nama',name : 'pegawai.nama', title : "Nama"},
                                {data : 'nip', title : "NIP"},
                                {data : 'jabatan',name : 'jabatan.nama_jabatan', title : "Jabatan"},
                                {data : 'penempatan', name : 'penempatan.nama_penempatan', title : "Penempatan"},
                                {data : 'grup', title : "Group"},
                                {data : 'status', name : 'absensi.kehadiran', title : "Status"},
                                {data : 'keterangan',  title : "Keterangan"}
                            ],
                })
            
                
        }

        function initTabelKosong(){
            $('#tabel').DataTable().destroy();
            return $('#tabel').DataTable()
        }
    </script>
@endpush
{{-- end Untuk datatable --}}
