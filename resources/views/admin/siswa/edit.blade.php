@extends('admin.layouts.app')
@section('title', 'Edit Siswa')
@section('content')
    <form action="{{ route('siswa.update', $siswa->id) }}" method="post" class="col-lg-6"
        enctype='multipart/form-data'>
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $siswa->id }}">
        <div class="form-group">
            <label for="kelas_id">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" value="{{ $siswa->kelas }}">
        </div>
        <div class="form-group">
            <label for="nis">Nis</label>
            <input type="text" class="form-control" id="nis" name="nis" value="{{ $siswa->nis }}">
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $siswa->nama }}">
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                value="{{ $siswa->tempat_lahir }}">
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                value="{{ $siswa->tanggal_lahir }}">
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                <option selected disabled class="bg-secondary">Pilih Jenis Kelamin</option>
                <option value="Pria" {{ $siswa->jenis_kelamin == 'Pria' ? 'selected' : null }}>Pria
                </option>
                <option value="Wanita" {{ $siswa->jenis_kelamin == 'Wanita' ? 'selected' : null }}>Wanita</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $siswa->alamat }}">
        </div>
        <div class="form-group">
            <label for="status">Status Anggota</label>
            <select class="form-control" id="status" name="status">
                <option selected disabled class="bg-secondary">Pilih Status Anggota</option>
                <option value="0" {{ $siswa->status == '0' ? 'selected' : null }}>Bukan Anggota OSIS
                </option>
                <option value="1" {{ $siswa->status == '1' ? 'selected' : null }}>Anggota OSIS</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <div class="form-group">
            {{ csrf_field() }}
            <label for="photo">Foto</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        <a class="btn btn-success" href="{{ route('siswa.index') }}" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </form>
@endsection
