<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Konfigurasi;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class HasilController extends Controller
{

    public function index()
    {
        $jmlhkandidat = Konfigurasi::get();
        $siswas = Siswa::where('status', 1)->get();
        $kriterias = Kriteria::all();
        $penilaian = Penilaian::all();
        $penilaian_siswa = DB::table('penilaian_siswa')->get();
        $kode_kriteria = [];

        if (count($penilaian_siswa) > 0) {
            foreach ($kriterias as $kriteria) {
                $kode_kriteria[$kriteria->id] = [];
                foreach ($siswas as $siswa) {
                    foreach ($siswa->penilaian as $penilaian) {
                        if ($penilaian->kriteria->id == $kriteria->id) {
                            $kode_kriteria[$kriteria->id][] = $penilaian->bobot;
                        }
                    }
                }

                if ($kriteria->sifat == 'Cost') {
                    $kode_kriteria[$kriteria->id] = min($kode_kriteria[$kriteria->id]);
                } else if ($kriteria->sifat == 'Benefit') {
                    $kode_kriteria[$kriteria->id] = max($kode_kriteria[$kriteria->id]);
                }
            }

            return view('admin.hasil.index', [
                'siswas' => $siswas,
                'kriterias' => $kriterias,
                'kode_kriteria' => $kode_kriteria
            ])->with('jmlhkandidat', $jmlhkandidat);
        }
        return abort(204);
    }

    public function jmlhkandidat(Request $request)
    {
        $delete = DB::table('konfigurasi');
        $delete->delete();
        $createData = new Konfigurasi;
        $createData->jmlh_kandidat = $request->jumlahkandidat;
        $createData->save();
        if ($createData) {
            return redirect()->route('hasil.index')->withSuccess('<strong>SUCCESS</strong>, Jumlah Kandidat berhasil diset!');
        }
    }

    public function saveHasil(Request $request)
    {
        $deleteAllKandidat = DB::table('kandidat');
        $deleteAllKandidat->delete();
        $data[] = $request->all();
        foreach ($data as $dt) {
            foreach ($dt['data'] as $d) {
                $array = [];
                $array = json_decode($d, true);
                if ($array['total'] != 0) {
                    $save = Kandidat::create($array);
                }
            }
        }
        if ($save) {
            return redirect()->route('hasil.kandidat')->withSuccess('<strong>SUCCESS!</strong>, Data has been saved!');
        }
    }

    public function kandidat()
    {
        $i = 1;
        $kandidat = Kandidat::all();
        return view('admin.kandidat.index', compact('kandidat', 'i', $kandidat));
    }

    public function update(Request $request)
    {
        $rules = $request->validate([
            'id' => 'required',
        ]);
        if ($rules) {
            $id = $request->id;
            if ($request->visi) {
                $visi = $request->visi;
            }
            if ($request->misi) {
                $misi = $request->misi;
            }
            if ($request->yt) {
                $yt = substr($request->yt, 32);
            }
            if ($id) {
                $updateData = Kandidat::findOrFail($id);
                if ($request->visi) {
                    $updateData->visi = $visi;
                }
                if ($request->misi) {
                    $updateData->misi = $misi;
                }
                if ($request->yt) {
                    $updateData->link = $yt;
                }
                $updateData->save();
                if ($updateData) {
                    return redirect()->route('hasil.kandidat')->withSuccess('<strong>SUCCESS</strong>, Perubahan data berhasil disimpan!');
                }
            }
        }
    }

    public function deleteKandidat()
    {
        $deleteAllKandidat = DB::table('kandidat');
        $deleteAllKandidat->delete();
        if ($deleteAllKandidat) {
            return redirect()->route('hasil.kandidat')->with('success', '<strong>SUCCESS!</strong>, data has been deleted!');
        }
    }

    public function hasilvote()
    {
        $i = 1;
        $kandidat = Kandidat::all();
        $jumlahsuara = DB::table('siswa')
            ->count();
        $suaramasuk = DB::table('pilihan')
            ->count();
        $belumvoting = $jumlahsuara - $suaramasuk;

        return view('admin.pemilihan.hasil', [
            'i' => $i,
            'kandidat' => $kandidat,
            'jumlahsuara' => $jumlahsuara,
            'suaramasuk' => $suaramasuk,
            'belumvoting' => $belumvoting
        ]);
    }

    public function hasilPdf()
    {
        $i = 1;
        $kandidat = Kandidat::all();
        $jumlahsuara = DB::table('siswa')
            ->count();
        $suaramasuk = DB::table('pilihan')
            ->count();
        $belumvoting = $jumlahsuara - $suaramasuk;

        $data = [
            'i' => $i,
            'kandidat' => $kandidat,
            'jumlahsuara' => $jumlahsuara,
            'suaramasuk' => $suaramasuk,
            'belumvoting' => $belumvoting
        ];
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadView('admin.pemilihan.cetak', $data)->setPaper('A4')->setOrientation('portrait');
        return $pdf->stream('Laporan.pdf');
    }
}
