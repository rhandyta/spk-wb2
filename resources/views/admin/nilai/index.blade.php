@extends('admin.layouts.app')
@section('title', 'Nilai Bobot Alternatif')
@section('content')
    <table class="table table-bordered">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambah-data">
            Tambah Data
        </button>

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nis</th>
                <th scope="col">Nama</th>
                <th scope="col">Kriteria</th>
                <th scope="col">Bobot</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($penilaian_siswa) < 1)
                <tr>
                    <td colspan="6" align="center">Tidak ada data!</td>
                </tr>
            @else
                @foreach ($penilaian_siswa as $ps)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $ps->siswa->nis }}</td>
                        <td>{{ $ps->siswa->nama }}</td>
                        <td>{{ $ps->penilaian->kriteria->nama }}</td>
                        <td>{{ $ps->penilaian->bobot }}</td>
                        <form action="{{ route('nilai.destroy', $ps->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <td>
                                <button type="submit" class="btn btn-danger btn-sm" id="btnHapus"
                                    onclick="deleteData()">Hapus</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $penilaian_siswa->links('pagination::bootstrap-4') }}

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="tambah-data" tabindex="-1" role="dialog"
        aria-labelledby="tambah-dataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-dataLabel">Tambah Data Nilai Bobot Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('nilai.store') }}" method="POST">
                        @csrf
                        {{-- <div class="form-group">
                        <label for="kriteria_id">Nama Kriteria</label>
                        <select class="form-control" id="kriteria_id" name="kriteria_id">
                            <option value="" disabled selected class="bg-secondary">Pilih Kriteria</option>
                            @foreach ($kriterias as $kriteria)
                                <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                        <div class="form-group">
                            <label for="siswa_id">Nama Siswa</label>
                            <select class="form-control" id="siswa_id" name="siswa_id">
                                <option value="" disabled selected class="bg-secondary">Pilih Siswa</option>
                                @foreach ($siswa->sortBy('nama') as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                @foreach ($kriterias as $k)
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label mb-3" for="nilai"> {{ $k->nama }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-auto">
                                @foreach ($judulForm as $key => $value)
                                    <div class="
                                form-group row">
                                        <select class="form-control mb-3 select" id="nilai" name="penilaian_id[]">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($value as $penilaian => $bobot)
                                                <option value="{{ $bobot['id'] }}">
                                                    {{ $bobot['keterangan'] }}
                                                </option>
                                            @endforeach
                                        </select><br>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- @foreach ($penilaian as $p)
                        <div class="form-group">
                            <label for="nama">{{ $p->kriteria->nama }}</label>
                            <select class="form-control" id="nama" name="nama">
                                <option value="" disabled selected class="bg-secondary">Pilih Siswa</option>
                                @foreach ($siswa as $s)
                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                            @endforeach
                            </select>
                        </div>
                    @endforeach --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        function deleteData() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
                    title: "Apa anda yakin?",
                    text: "Data yang telah dihapus akan hilang permanen.",
                    icon: "warning",
                    buttons: {
                        cancel: true,
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "",
                            closeModal: true
                        }
                    }
                })
                .then((isConfirm) => {
                    if (isConfirm) {
                        form.submit(); // submitting the form when user press yes
                    } else {
                        swal("Dibatalkan", "Data telah diamankan kembali :)", "info");
                    }
                });
        }
    </script>
@endsection
