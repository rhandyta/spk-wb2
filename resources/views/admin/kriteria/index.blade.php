@extends('admin.layouts.app')
@section('title', 'Kriteria')
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
                <th scope="col">Sifat</th>
                <th scope="col">Bobot</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($kriterias) < 1)
                <tr>
                    <td colspan="4" align="center">Tidak ada data!</td>
                </tr>
            @else
                @foreach ($kriterias as $kriteria)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $kriteria->nama }}</td>
                        <td>{{ $kriteria->sifat }}</td>
                        <td>{{ number_format($kriteria->bobot, 2) }}</td>
                        <form action="{{ route('kriteria.destroy', ['kriterium' => $kriteria->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <td>
                                <a class="btn btn-success btn-sm"
                                    href="{{ route('kriteria.edit', $kriteria->id) }}">Ubah</a>
                                <button type="submit" class="btn btn-danger btn-sm" id="btnHapus"
                                    onclick="deleteData()">Hapus</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $kriterias->links('pagination::bootstrap-4') }}

    <!-- Modal -->
    <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="tambah-dataLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-dataLabel">Tambah Data Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kriteria.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Kriteria</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="bobot">Bobot</label>
                            <input type="number" step="0.01" min="0.01" max="1" class="form-control" id="bobot"
                                name="bobot">
                        </div>
                        <div class="form-group">
                            <label for="sifat">Sifat</label>
                            <select class="form-control" id="sifat" name="sifat">
                                <option value="" disabled selected class="bg-secondary">Pilih Sifat</option>
                                <option value="Benefit">Benefit</option>
                                <option value="Cost">Cost</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
