@extends('admin.layouts.app')
@section('title', 'Hasil')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">Matriks Keputusan</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($siswas->sortBy('nama') as $siswa)
                        <tr id="data">
                            <td>{{ $siswa->nama }}</td>
                            @foreach ($siswa->penilaian as $nilai)
                                <td>{{ $nilai->bobot }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
                <br>

                {{-- normalisasi --}}
                <h4 class="card-title mb-2">Normalisasi Matriks Keputusan</h4>
                <table class="table table-striped table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <?php $bobot = []; ?>
                            @foreach ($kriterias as $kriteria)
                                @php
                                    $bobot[$kriteria->id] = $kriteria->bobot;
                                @endphp
                                <th>{{ $kriteria->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($siswas))
                            <?php $ranking = []; ?>
                            @foreach ($siswas->sortBy('nama') as $siswa)
                                <tr>
                                    <td>{{ $siswa->nama }}</td>
                                    <?php $total = 0; ?>
                                    @foreach ($siswa->penilaian as $penilaian)
                                        @if ($penilaian->kriteria->sifat == 'Cost')
                                            <?php $normalisasi = number_format($kode_kriteria[$penilaian->kriteria->id] / $penilaian->bobot, 2); ?>
                                        @elseif ($penilaian->kriteria->sifat == 'Benefit')
                                            <?php
                                            $normalisasi = number_format($penilaian->bobot / $kode_kriteria[$penilaian->kriteria->id], 2);
                                            ?>
                                        @endif
                                        @php
                                            $total = number_format($total + $bobot[$penilaian->kriteria->id] * $normalisasi, 2);
                                        @endphp
                                        <td>{{ $normalisasi }}</td>
                                    @endforeach
                                    @php
                                        $ranking[] = [
                                            'siswa_id' => $siswa->id,
                                            'nis' => $siswa->nis,
                                            'nama' => $siswa->nama,
                                            'total' => $total,
                                        ];
                                    @endphp
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="{{ count($kriteria) + 1 }}">Data tidak ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <br>

                {{-- perankingan --}}
                <h4 class="card-title mb-2">Perankingan</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Total</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            usort($ranking, function ($a, $b) {
                                return strcmp($a['total'], $b['total']);
                            });
                            $ranking = array_reverse($ranking);
                            $a = 1;
                        @endphp
                        @foreach ($ranking as $t)
                            <tr>
                                <td>[{{ $t['nis'] }}] - {{ $t['nama'] }}</td>
                                <td>{{ $t['total'] }}</td>
                                <td>{{ $a++ }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>
                <!-- Ranking -->
                <div class="card">
                    <div class="card-header">
                        <h3>Kesimpulan</h3>
                    </div>
                    <div class="card-body">
                        @if (count($jmlhkandidat) > 0)
                            <h4>Maka, dapat disimpulkan kandidat Ketua OSIS adalah <br>
                                @foreach ($jmlhkandidat as $kandidat)
                                    @foreach (array_slice($ranking, 0, $kandidat->jmlh_kandidat) as $r)
                                        <strong>{{ $r['nama'] }}</strong><br>
                                    @endforeach
                            </h4>
                            <form action="{{ route('hasil.saveHasil') }}" method="post">
                                @csrf
                                @foreach (array_slice($ranking, 0, $kandidat->jmlh_kandidat) as $data)
                                    <input type="hidden" name="data[]" value="{{ json_encode($data, true) }}">
                                @endforeach
                        @endforeach
                        <hr>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#ubahjmlhkandidat">Jumlah Kandidat</button>
                        </form>
                        @endif
                        @if (count($jmlhkandidat) < 1)
                            <h4>Maka, dapat disimpulkan kandidat Ketua OSIS adalah <br>
                                @foreach (array_slice($ranking, 0, 2) as $r)
                                    <strong>{{ $r['nama'] }}</strong><br>
                                @endforeach
                            </h4>
                            <form action="{{ route('hasil.saveHasil') }}" method="post">
                                @csrf
                                @foreach (array_slice($ranking, 0, 2) as $data)
                                    <input type="hidden" name="data[]" value="{{ json_encode($data, true) }}">
                                @endforeach
                                <hr>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#ubahjmlhkandidat">Jumlah Kandidat</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ubahjmlhkandidat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atur Jumlah Kandidat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jumlah.kandidat') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="jumlahkandidat">Jumlah Kandidat</label>
                            <input class="form-control" type="number" step="1" min="1" max="10" name="jumlahkandidat">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
