<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WB 2 | Pengajuan Kandidat</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Pengajuan Kandidat</h1>
                                        @include('admin.layouts.partials.alert')
                                    </div>
                                    <form action="{{ route('store.kandidat') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>NIS</label>
                                            <input type="text" name="nis" id="nis" placeholder="Enter nis name"
                                                class="form-control">
                                            <input type="hidden" name="id" id="id">
                                        </div>
                                        <div id="nis_list"></div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <input type="text" name="kelas" id="kelas" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="visi" id="visi" cols="30" rows="3"
                                                placeholder="Visi"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="misi" id="misi" cols="30" rows="3"
                                                placeholder="Misi"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="link"
                                                name="link" placeholder="Link Youtube">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Pengajuan Kandidat
                                        </button>
                                    </form>
                                    <div class="text-center">
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('landingpage') }}">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#nis').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('search.siswa') }}",
                    method: "get",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        let json = data;
                        obj = JSON.parse(json);
                        $('#id').val(obj.id);
                        $('#nama').val(obj.nama);
                        $('#kelas').val(obj.kelas);

                    }
                });
            }
        });

    });
</script>

</body>

</html>
