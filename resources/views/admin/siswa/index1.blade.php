@extends('admin.layouts.app')
@section('title', 'Siswa')
@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-data">
                Tambah Data
            </button>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('siswa.search') }}">
                <div class="input-group">
                    <input type="text" name="cari" id="cari" class="form-control bg-light border-0 small">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </nav>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nis</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Email</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($siswas) < 1)
                <tr>
                    <td colspan="4" align="center">Tidak ada data!</td>
                </tr>
            @else
                @foreach ($siswas as $siswa)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->kelas->nama }}-{{ $siswa->kelas->jurusan->alias }} {{ $siswa->kelas->ruangan }}
                        </td>
                        <td>{{ $siswa->email }}</td>
                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('siswa.show', $siswa->id) }}">Detail</a>
                                <a class="btn btn-success btn-sm" href="{{ route('siswa.edit', $siswa->id) }}">Ubah</a>
                                <button type="submit" class="btn btn-danger btn-sm" id="btnHapus"
                                    onclick="deleteData()">Hapus</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $siswas->links('pagination::bootstrap-4') }}


    <!-- Modal -->
    <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="tambah-dataLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-dataLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select class="form-control" id="kelas_id" name="kelas_id">
                                <option value="" disabled selected class="bg-secondary">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">
                                        {{ $k->nama }}-{{ $k->jurusan->alias }}{{ $k->ruangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nis">Nis</label>
                            <input type="text" class="form-control" id="nis" name="nis">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="" disabled selected class="bg-secondary">Pilih Jenis Kelamin</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="photo">Foto</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo" name="photo">
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Status Aktif</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="" disabled selected class="bg-secondary">Pilih Status Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                                <option value="Aktif">Aktif</option>
                            </select>
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
        $('#cari').on('keyup', function() {
            let cari = $(this).val();
            $.ajax({
                type: 'get',
                url: "{{ route('siswa.search') }}",
                data: {
                    'cari': cari
                },
                success: function(data) {
                    $('tbody').html(data)
                }
            })
        })
    </script>

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
