<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KandidatController extends Controller
{
    public function pengajuan()
    {
        return view('siswa.daftarkandidat');
    }
    public function search(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('siswa')
                ->where('nis', 'LIKE', "%{$query}%")
                ->orWhere('nama', 'LIKE', "%{$query}%")
                ->orWhere('kelas', 'LIKE', "%{$query}%")
                ->get();
            $a = [];
            foreach ($data as $row) {
                $a = [
                    'id' => $row->id,
                    'nis' => $row->nis,
                    'nama' => $row->nama,
                    'kelas' => $row->kelas,
                ];
            }
            return json_encode($a);
        }
    }

    public function store(Request $request)
    {
        $rules = $request->validate([
            'id' => 'required|unique:kandidat,siswa_id',
            'nis' => 'required|unique:kandidat,nis',
            'nama' => 'required|unique:kandidat,nama',
            'visi' => 'required',
            'misi' => 'required',
            'link' => 'required'
        ]);

        if ($rules) {
            $createData = new Kandidat;
            $createData->siswa_id = $request->id;
            $createData->nis = $request->nis;
            $createData->nama = $request->nama;
            $createData->visi = $request->visi;
            $createData->misi = $request->misi;
            $createData->link = substr($request->link, 32);
            $createData->save();
            if ($createData) {
                return redirect()->route('pengajuan.kandidat')->withSuccess('Berhasil pengajuan');
            }
        }
    }
}
