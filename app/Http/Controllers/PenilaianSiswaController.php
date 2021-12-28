<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Penilaian_siswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenilaianSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 5;
        $kriterias = Kriteria::all();
        $siswa = Siswa::where('status', 1)->get();
        $penilaian_siswa = Penilaian_siswa::paginate(5);

        $judul = [];
        $nameForm = $kriterias->pluck('id');
        foreach ($nameForm as $name) {
            $penilaian = Penilaian::where('kriteria_id', $name)->get();
            array_push($judul, $penilaian);
        }
        $judulForm = $judul;
        return view('admin.nilai.index', compact('kriterias', 'siswa', 'judulForm', 'penilaian_siswa', $kriterias, $siswa, $judulForm, $penilaian_siswa,))->with('i', ($request->input('page', 1) - 1) * $paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|unique:penilaian_siswa,siswa_id',
            'penilaian_id.*' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('nilai.index')
                ->withErrors($validator)
                ->withInput();
        }
        // $rules = $this->validate($request, [
        //     'siswa_id' => 'required',
        //     'penilaian_id.*' => 'required',
        // ]);
        $nilai = $request->input('penilaian_id');

        foreach ($nilai as $answer) {
            $siswa_id[] = $request->siswa_id;
        }

        $siswa_id;

        $allData = array();
        for ($x = 0; $x < count($nilai); $x++) {
            $row = array(
                'siswa_id'      => $siswa_id[$x],
                'penilaian_id'  => $nilai[$x],
            );
            array_push($allData, $row);
        }

        $createData = Penilaian_siswa::insert($allData);
        if ($createData) {
            return \redirect()->route('nilai.index')->withSuccess('<strong>SUCCESS!</strong>, Data has been created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Penilaian_siswa::findOrFail($id);
        $hapus->delete();
        if ($hapus) {
            return redirect()->route('nilai.index')->with('success', "<strong>SUCCESS</strong>Data has been deleted!");
        }
    }
}
