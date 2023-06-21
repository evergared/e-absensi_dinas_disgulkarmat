@extends('layouts.absensi-dinas-dashboard-layout')

@section('content')
        <div class="container-fluid px-4">

            <h1 class="mt-4">Histori Absensi Harian Anda</h1>
            @include('layouts.others.breadcrumbs')
            
            <div class="card">
                <div class="card-header">
                    <h2>Absensi Harian Anda</h2>
                </div>
                <div class="card-body overflow-auto">
                    <div id="kalender-histori"></div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
@endsection

@push('stack-head')
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
@endpush

@push('stack-body')
    <script>
        var myConfig = {
                type: 'calendar',
                options: {
                    year: {
                    text: '2023',
                    visible: false
                    },
                    startMonth: 1,
                    endMonth: 6,
                    palette: ['none', '#2196F3'],
                    month: {
                    item: {
                        fontColor: 'gray',
                        fontSize: 9
                    }
                    },
                    weekday: {
                    values: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                    item: {
                        fontColor: 'gray',
                        fontSize: 9
                    }
                    },
                    values: [
                    ['2023-01-01', 3],
                    ['2023-01-04', 12],
                    ['2023-01-05', 3],
                    ['2023-01-06', 4],
                    ['2023-01-07', 9],
                    ['2023-01-08', 11],
                    ['2023-01-11', 5],
                    ['2023-01-12', 5],
                    ['2023-01-13', 9],
                    ['2023-01-14', 9],
                    ['2023-01-15', 9],
                    ['2023-01-18', 4],
                    ['2023-01-19', 6],
                    ['2023-01-20', 5],
                    ['2023-01-21', 6],
                    ['2023-01-22', 2],
                    ['2023-01-25', 5],
                    ['2023-01-26', 9],
                    ['2023-01-27', 6],
                    ['2023-01-28', 6],
                    ['2023-01-29', 7],
                    ['2023-02-01', 7],
                    ['2023-02-02', 12],
                    ['2023-02-03', 3],
                    ['2023-02-04', 3],
                    ['2023-02-05', 9],
                    ['2023-02-08', 9],
                    ['2023-02-09', 9],
                    ['2023-02-10', 4],
                    ['2023-02-11', 5],
                    ['2023-02-12', 8],
                    ['2023-02-15', 8],
                    ['2023-02-16', 3],
                    ['2023-02-17', 7],
                    ['2023-02-18', 5],
                    ['2023-02-19', 9],
                    ['2023-02-22', 6],
                    ['2023-02-23', 5],
                    ['2023-02-24', 8],
                    ['2023-02-25', 10],
                    ['2023-02-26', 4],
                    ['2023-02-29', 5],
                    ['2023-03-01', 9],
                    ['2023-03-02', 9],
                    ['2023-03-03', 3],
                    ['2023-03-04', 3],
                    ['2023-03-07', 4],
                    ['2023-03-08', 2],
                    ['2023-03-09', 10],
                    ['2023-03-10', 9],
                    ['2023-03-11', 7],
                    ['2023-03-14', 8],
                    ['2023-03-15', 7],
                    ['2023-03-16', 8],
                    ['2023-03-17', 8],
                    ['2023-03-18', 2],
                    ['2023-03-21', 3],
                    ['2023-03-22', 4],
                    ['2023-03-23', 5],
                    ['2023-03-24', 6],
                    ['2023-03-25', 7],
                    ['2023-03-28', 8],
                    ['2023-03-29', 8],
                    ['2023-03-30', 9],
                    ['2023-03-31', 7],
                    ['2023-04-01', 9],
                    ['2023-04-04', 7],
                    ['2023-04-05', 5],
                    ['2023-04-06', 6],
                    ['2023-04-07', 9],
                    ['2023-04-08', 4],
                    ['2023-04-11', 8],
                    ['2023-04-12', 9],
                    ['2023-04-13', 3],
                    ['2023-04-14', 5],
                    ['2023-04-15', 5],
                    ['2023-04-18', 8],
                    ['2023-04-19', 8],
                    ['2023-04-20', 9],
                    ['2023-04-21', 3],
                    ['2023-04-22', 6],
                    ['2023-04-25', 12],
                    ['2023-04-26', 6],
                    ['2023-04-27', 5],
                    ['2023-04-28', 5],
                    ['2023-04-29', 11],
                    ['2023-05-02', 9],
                    ['2023-05-03', 3],
                    ['2023-05-04', 5],
                    ['2023-05-05', 4],
                    ['2023-05-06', 9],
                    ['2023-05-09', 5],
                    ['2023-05-10', 5],
                    ['2023-05-11', 7],
                    ['2023-05-12', 7],
                    ['2023-05-13', 5],
                    ['2023-05-16', 3],
                    ['2023-05-17', 2],
                    ['2023-05-18', 7],
                    ['2023-05-19', 5],
                    ['2023-05-20', 3],
                    ['2023-05-23', 9],
                    ['2023-05-24', 11],
                    ['2023-05-25', 5],
                    ['2023-05-26', 9],
                    ['2023-05-27', 4],
                    ['2023-05-30', 5],
                    ['2023-05-31', 7],
                    ['2023-06-01', 9],
                    ['2023-06-02', 5],
                    ['2023-06-03', 5],
                    ['2023-06-06', 6],
                    ['2023-06-07', 7],
                    ['2023-06-08', 8],
                    ['2023-06-09', 5],
                    ['2023-06-10', 8],
                    ['2023-06-13', 6],
                    ['2023-06-14', 6],
                    ['2023-06-15', 2],
                    ['2023-06-16', 7],
                    ['2023-06-17', 5],
                    ['2023-06-20', 5],
                    ['2023-06-21', 8],
                    ['2023-06-22', 8],
                    ['2023-06-23', 8],
                    ['2023-06-24', 10],
                    ['2023-06-27', 7],
                    ['2023-06-28', 12],
                    ['2023-06-29', 7],
                    ['2023-06-30', 6],
                    ]
                },
                labels: [{ //Lefthand Label (container portion)
                    borderColor: 'gray',
                    borderWidth: 1,
                    x: '8%',
                    y: '60%',
                    width: '40%',
                    height: '30%'
                    },
                    { //Lefthand Label (top portion)
                    text: 'Daily Contribution',
                    fontColor: '#212121',
                    textAlign: 'center',
                    x: '10%',
                    y: '65%',
                    width: '36%'
                    },
                    { //Lefthand Label (middle portion)
                    text: '%plot-value',
                    fontColor: '#2196F3',
                    fontFamily: 'Georgia',
                    fontSize: 35,
                    textAlign: 'center',
                    x: '10%',
                    y: '68%',
                    width: '36%'
                    },
                    // Note: the bottom portion of the Bottom-Left Label is the fixed tooltip, below.
                
                    { //Rightside Label (container portion)
                    borderColor: 'gray',
                    borderWidth: 1,
                    x: '52%',
                    y: '60%',
                    width: '40%',
                    height: '30%',
                    },
                    { //Rightside Label (top portion)
                    text: 'Total Contributions',
                    fontColor: '#212121',
                    textAlign: 'center',
                    x: '54%',
                    y: '65%',
                    width: '36%'
                    },
                    { //Rightside Label (middle portion)
                    text: '1414',
                    fontColor: '#2196F3',
                    fontFamily: 'Georgia',
                    fontSize: 35,
                    textAlign: 'center',
                    x: '54%',
                    y: '68%',
                    width: '36%'
                    },
                    { //Rightside Label (bottom portion)
                    text: 'Jan 1 - Jun 30',
                    fontColor: '#212121',
                    padding: 2,
                    textAlign: 'center',
                    x: '54%',
                    y: '80%',
                    width: '36%'
                    }
                ],
                
                tooltip: { //Lefthand Label (bottom portion)
                    text: '%data-day',
                    backgroundColor: 'none',
                    borderColor: 'none',
                    fontColor: '#212121',
                    padding: 2,
                    //textAlign: 'center',
                    align: 'center',
                    sticky: true,
                    timeout: 30000,
                    x: '10%',
                    y: '80%',
                    width: '36%'
                },
                
                plotarea: {
                    marginTop: '15%',
                    marginBottom: '55%',
                    marginLeft: '8%',
                    marginRight: '8%'
                }
                };
                
                zingchart.loadModules('calendar', function() {
                zingchart.render({
                    id: 'kalender-histori',
                    data: myConfig,
                    height: 400,
                    width: '100%'
                });
            });
    </script>
@endpush