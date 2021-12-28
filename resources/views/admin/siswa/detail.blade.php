@extends('admin.layouts.app')
@section('title', 'Siswa')
@section('content')

    <div class="main-body">

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($siswa->photo == 'default.jpg')
                                <img src="{{ asset('assets/images/siswa/default.jpg') }}" alt="Siswa"
                                    class="rounded-circle" width="150">
                            @endif
                            @if ($siswa->photo != 'default.jpg')
                                <img src="https://drive.google.com/uc?id={{ $url }}" alt="Siswa"
                                    class="rounded-circle" width="150">
                            @endif
                            <div class="mt-3">
                                <h4>{{ $siswa->nama }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nis</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $siswa->nis }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Kelas</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $siswa->kelas }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Keanggotaan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $siswa->status == 1 ? 'Anggota OSIS' : 'Tidak Anggota OSIS' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">TTL</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Jenis Kelamin</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $siswa->jenis_kelamin }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $siswa->alamat }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info " href="{{ route('siswa.edit', $siswa->id) }}">Ubah</a>
                                <a class="btn btn-success " href="{{ route('siswa.index') }}">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>

    </div>
@endsection
