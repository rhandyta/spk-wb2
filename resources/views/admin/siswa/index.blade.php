@extends('admin.layouts.app')
@section('title', 'Siswa')
@section('content')
    <div class="row">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambah-data">
            Tambah Data
        </button>
        <button type="button" class="btn btn-primary mb-2 ml-2" data-toggle="modal" data-target="#tambah-excel">
            Import Excel
        </button>
        <form action="{{ route('export.siswa') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary mb-2 ml-2">
                Export Excel
            </button>
        </form>
        <form action="{{ route('delete.siswa') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mb-2 ml-2">
                Reset Siswa
            </button>
        </form>
    </div>
    <table class="table table-striped table-bordered table-sm" id="dataTable">
        <thead>
            <tr>
                <th scope="col">Nis</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>


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
                        <input type="hidden" name="user_id" id="id" value="{{ Auth::guard('')->id() }}">
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <input type="text" name="kelas" id="kelas" class="form-control">
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
                            <label for="status">Status Siswa</label>
                            <select class="form-control" id="status" name="status">
                                <option value="" disabled selected class="bg-secondary">Pilih Keanggotan</option>
                                <option value="0">Bukan Anggota OSIS</option>
                                <option value="1">Anggota OSIS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label for="photo">Foto</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
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
    <!-- Modal Excel -->
    <div class="modal fade" id="tambah-excel" tabindex="-1" role="dialog" aria-labelledby="tambah-dataLabel"
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
                    {{-- <p class="text-danger">*Jika ingin import data excel, perhatikan id kelas yang tersedia. jika tidak
                        ada input terlebih dahulu. cocokkan id kelas dengan yang terdapat pada excel!.</p> --}}
                    <form action="{{ route('import.siswa') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="excel">File</label>
                            <input type="file" class="form-control-file" id="excel" name="excel" required="required">
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

    <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PERHATIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Jika menghapus siswa maka</b></p>
                    <p class="text-danger">*data siswa tersebut hilang selamanya, apakah anda yakin?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                        Data</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                "ajax": "data/arrays.txt",
                "deferRender": true,
                "order": [
                    [0, "asc"]
                ],
                ajax: '{{ route('siswa.index') }}',
                columns: [{
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'siswa',
                        name: 'siswa'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sClass: 'text-center'
                    },
                ]
            });

            $(document).on('click', '.delete', function() {
                dataId = $(this).attr('id');
                $('#konfirmasi-modal').modal('show');
            });

            $('#tombol-hapus').click(function() {
                $.ajax({
                    url: "/admin/siswa/" + dataId, //eksekusi ajax ke url ini
                    type: 'delete',
                    beforeSend: function() {
                        $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                    },
                    success: function(data) { //jika sukses
                        setTimeout(function() {
                            $('#konfirmasi-modal').modal(
                                'hide'); //sembunyikan konfirmasi modal
                            var oTable = $('.dataTable').dataTable();
                            oTable.fnDraw(false); //reset datatable
                        });
                        iziToast.warning({ //tampilkan izitoast warning
                            title: 'Data Berhasil Dihapus',
                            message: '{{ Session('
                        delete ') }}',
                            position: 'bottomRight'
                        });
                    }
                })

            });
        })
    </script>



@endsection
