@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

    <div class="row">
        <div class="table-responsive-sm col-lg-6">
            <div class="card">
                <div class="card header">
                    <h6 class="my-2 font-weight-bold text-primary text-center">Baru baru ini memilih</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>Nama</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($voted) < 1)
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada data!</td>
                                </tr>
                            @else
                                @foreach ($voted as $vote)
                                    <tr>
                                        <td>{{ $vote->siswa->nama }}</td>
                                        <td class="text-center">
                                            {{ $vote->created_at->diffForHumans() }}
                                            {{-- {{ date('l G:i T', strtotime($vote->created_at)) }} --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $voted->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection
