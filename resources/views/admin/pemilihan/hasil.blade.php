@extends('admin.layouts.app')
@section('title', 'Hasil Pemilihan')
@section('content')


    <div class="panel panel-headline">
        <a href="{{ route('hasil.cetak') }}" target="_blank" class="btn btn-success btn-small">Cetak</a>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">
                                {{ count($kandidat) }}
                            </span>
                            <span class="title">Kandidat</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-volume-up"></i></span>
                        <p>
                            <span class="number">
                                {{ $jumlahsuara }}
                            </span>
                            <span class="title">Hak Suara</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-database"></i></span>
                        <p>
                            <span class="number">
                                {{ $suaramasuk }}
                            </span>
                            <span class="title">Suara masuk</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-database"></i></span>
                        <p>
                            <span class="number">
                                {{ $belumvoting }}
                            </span>
                            <span class="title">Suara Belum masuk</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="width:100%;">
                    <div id="chartHasil"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2 text-center">Kandidat</h4>
                <div class="row justify-content-center">
                    @if (count($kandidat) < 1)
                        Tidak ada data!
                    @else
                        @foreach ($kandidat as $k)
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3 class="text-center">{{ $i++ }}</h3>
                                        @if ($k->siswa->photo == 'default.jpg')
                                            <img src="{{ asset('assets/images/siswa/default.jpg') }}" alt="Siswa"
                                                class="img-fluid img-thumbnail">
                                        @endif
                                        @if ($k->siswa->photo != 'default.jpg')
                                            <img src="https://drive.google.com/uc?id={{ $k->siswa->photo }}" alt="Siswa"
                                                class="img-fluid img-thumbnail">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <h6 class="text-center">{{ $k->siswa->nama }}</h6>
                                        </div>
                                        <h6 class="text-center">
                                            {{ $k->siswa->nis }}
                                        </h6>
                                        <h6 class="text-center">
                                            {{ $k->siswa->kelas }}
                                        </h6>
                                        <h6 class="text-center">
                                            {{ $k->siswa->jenis_kelamin }}
                                        </h6>
                                    </div>
                                    <div class="card-footer d-flex justify-content-center">
                                        <h4>VOTE : {{ count($k->pilihan) }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <br>
            </div>
        </div>
    </div>




@endsection
@section('js')

    {{-- <script src="{{ asset('/js/chart.js') }}"></script>
    <script type="text/javascript">
        // Create the chart
        Highcharts.chart('chartHasil', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Perolehan Suara.'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total suara yang di dapat'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        // format: '{point.y:.1f}%'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Suara<br/>'
            },
            series: [{
                name: "Total",
                colorByPoint: true,
                data: [
                    <?php foreach($jumlahsuara as $nk){?> {
                        name: "<?php echo $nk->nama; ?>",
                        y: <?php echo $nk->jumlahsuara; ?>,
                        drilldown: "<?php echo $nk->nama; ?>"
                    },
                    <?php }?>
                    <?php foreach($belumvoting as $bl){?> {
                        name: "Belum Voting",
                        y: <?php echo $bl->jumlahbelumvoting; ?>,
                        drilldown: "Token Tidak Dipakai"
                    }
                    <?php }?>
                ]
            }]

        });
    </script> --}}

@endsection
