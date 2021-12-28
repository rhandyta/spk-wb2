@extends('admin.layouts.app')
@section('title', 'Kandidat')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <form action="{{ route('delete.kandidat') }}" method="post">
            @method('delete')
            @csrf
            <button class="btn btn-danger mb-3">Reset</button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-data">
                Tambah Data
            </button>
        </form>
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-2 text-center">Kandidat</h4>
                <div class="row justify-content-center">
                    @if (count($kandidat) < 1)
                        Tidak ada data!
                    @else
                        @foreach ($kandidat as $k)
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h3 class="text-center">{{ $i++ }}</h3>
                                        @if ($k->siswa->photo == 'default.jpg')
                                            <img src="{{ asset('assets/images/siswa/default.jpg') }}" alt="Siswa"
                                                class="img-fluid img-thumbnail">
                                        @endif
                                        @if ($k->siswa->photo != 'default.jpg')
                                            <img src="https://drive.google.com/uc?id={{ $k->siswa->photo }}"
                                                class="img-fluid img-thumbnail">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <h6 class="text-center">{{ $k->siswa->nama }}</h6>
                                        </div>
                                        <h6 class="text-center">
                                            {{ $k->siswa->nis }}
                                        </h6>
                                        <h6 class="text-center">
                                            {{ $k->siswa->kelas }}
                                            <h6 class="text-center">
                                                {{ $k->siswa->jenis_kelamin }}
                                            </h6>
                                    </div>
                                    <div class="card-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModalCenter{{ $k->id }}">
                                            Detail
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{ $k->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Detail
                                                            Kandidat Ketua OSIS</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Visi</h5>
                                                        <p>{{ $k->visi }}</p>
                                                        <hr>
                                                        <h5>Misi</h5>
                                                        <p>{{ $k->misi }}</p>
                                                        <hr>
                                                        <h5>Video</h5>
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item"
                                                                src="https://www.youtube.com/embed/{{ $k->link }}"
                                                                allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <br>


            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="tambah-dataLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-dataLabel">Tambah Data Visi-Misi & Link YT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.kandidat') }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <select name="id" id="nama" class="form-control">
                                <option value="" disabled selected>Pilih Kandidat</option>
                                @foreach ($kandidat as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="visi">Visi</label>
                            <textarea name="visi" id="visi" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="misi">Misi</label>
                            <textarea name="misi" id="misi" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="yt">Link YT</label>
                            <input type="text" class="form-control" id="yt" name="yt">
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
@endsection
