@extends('admin.layouts.app')
@section('title', 'Edit Kriteria')
@section('content')
    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="post" class="col-lg-6">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $kriteria->id }}">
        <div class="form-group">
            <label for="nama">Nama Kriteria</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $kriteria->nama }}">
        </div>
        <div class="form-group">
            <label for="bobot">Bobot</label>
            <input type="number" step="0.01" min="0.01" max="1" class="form-control" id="bobot" name="bobot"
                value="{{ number_format($kriteria->bobot, 2) }}">
        </div>
        <div class="form-group">
            <label for="sifat">Sifat</label>
            <select class="form-control" id="sifat" name="sifat">
                <option selected disabled class="bg-secondary">Pilih Sifat</option>
                <option value="Benefit" {{ $kriteria->sifat == 'Benefit' ? 'selected' : null }}>Benefit
                </option>
                <option value="Cost" {{ $kriteria->sifat == 'Cost' ? 'selected' : null }}>Cost</option>
            </select>
        </div>
        <a class="btn btn-secondary" href="{{ route('kriteria.index') }}" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </form>
@endsection
