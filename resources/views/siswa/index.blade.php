@extends('admin.layouts.app')
@section('title', 'Pemilihan Siswa')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2 text-center">Kandidat</h4>
                <div class="row justify-content-center">
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
                                        <img src="https://drive.google.com/uc?id={{ $k->siswa->photo }}" alt="Siswa"
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
                                    </h6>
                                    <h6 class="text-center">
                                        {{ $k->siswa->jenis_kelamin }}
                                    </h6>
                                    <div class="d-flex justify-content-center">
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
                                @if ($query->isEmpty())
                                    <div class="card-footer d-flex justify-content-center">
                                        <form action="{{ route('vote.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $k->id }}" name="kandidat_id">
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="siswa_id">
                                            <button type="submit" class="btn btn-success ">VOTE</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <br>


            </div>
        </div>
    </div>


@endsection
@section('js')
@endsection
