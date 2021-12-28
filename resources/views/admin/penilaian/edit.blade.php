@extends('admin.layouts.app')
@section('title', 'Nilai Crips')
@section('content')
    <form action="{{ route('penilaian.update', ['penilaian' => $penilaian->id]) }}" method="post" class="col-lg-6">
        @csrf
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $penilaian->id }}">
        <div class="form-group">
            <label for="kriteria_id">Kriteria</label>
            <select class="form-control" id="kriteria_id" name="kriteria_id">
                <option selected disabled class="bg-secondary">Pilih Kriteria</option>
                @foreach ($kriterias as $kriteria)
                    <option value="{{ $kriteria->id }}"
                        {{ $penilaian->kriteria_id == $kriteria->id ? 'selected' : null }}>{{ $kriteria->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan"
                value="{{ $penilaian->keterangan }}">
        </div>
        <div class="form-group">
            <label for="bobot">Bobot</label>
            <input type="number" step="1" min="0" max="5" class="form-control" id="bobot" name="bobot"
                value="{{ $penilaian->bobot }}">
        </div>
        <a class="btn btn-secondary" href="{{ route('penilaian.index') }}" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </form>
@endsection
