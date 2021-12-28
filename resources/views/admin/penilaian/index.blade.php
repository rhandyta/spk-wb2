@extends('admin.layouts.app')
@section('title', 'Nilai Crips')
@section('content')
    <table class="table table-bordered">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambah-data">
            Tambah Data
        </button>

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kriteria</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Bobot</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($penilaian) < 1)
                <tr>
                    <td colspan="5" align="center">Tidak ada data!</td>
                </tr>
            @else
                @foreach ($penilaian as $nilai)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $nilai->kriteria->nama }}</td>
                        <td>{{ $nilai->keterangan }}</td>
                        <td>{{ $nilai->bobot }}</td>
                        <form action="{{ route('penilaian.destroy', ['penilaian' => $nilai->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <td>
                                <a class="btn btn-success btn-sm"
                                    href="{{ route('penilaian.edit', ['penilaian' => $nilai->id]) }}">Ubah</a>
                                <button type="submit" class="btn btn-danger btn-sm" id="btnHapus"
                                    onclick="deleteData()">Hapus</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $penilaian->links('pagination::bootstrap-4') }}

    <!-- Modal -->
    <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="tambah-dataLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-dataLabel">Tambah Data Nilai Crips</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('penilaian.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kriteria_id">Kriteria</label>
                            <select class="form-control" id="kriteria_id" name="kriteria_id">
                                <option value="" disabled selected class="bg-secondary">Pilih Kriteria</option>
                                @foreach ($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                        </div>
                        <div class="form-group">
                            <label for="bobot">Bobot</label>
                            <input type="number" step="1" min="0" max="5" class="form-control" id="bobot" name="bobot">
                        </div>
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
