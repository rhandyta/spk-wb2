<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 5;
        $penilaian = Penilaian::paginate(5);
        $kriterias = Kriteria::all();
        return view('admin.penilaian.index', compact('penilaian', 'kriterias', $kriterias, $penilaian))->with('i', ($request->input('page', 1) - 1) * $paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $request->validate([
            'kriteria_id' => 'required',
            'keterangan' => 'required',
            'bobot' => 'required|numeric'
        ]);
        if ($rules) {
            $createData = new Penilaian;
            $createData->kriteria_id = (int)$request->kriteria_id;
            $createData->keterangan = $request->keterangan;
            $createData->bobot = (float)$request->bobot;
            $createData->save();
            if ($createData) {
                return redirect()->route('penilaian.index')->withSuccess('<strong>SUCCESS!</strong>, Data has been created!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Penilaian $penilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penilaian $penilaian)
    {
        $kriterias = Kriteria::all();
        return view('admin.penilaian.edit', compact('kriterias', 'penilaian', $kriterias, $penilaian));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penilaian $penilaian)
    {

        $rules = $request->validate([
            'kriteria_id' => 'required',
            'keterangan' => 'required',
            'bobot' => 'numeric|required'
        ]);
        $id = (int)$request->id;
        $kriteria_id = (int)$request->kriteria_id;
        $keterangan = $request->keterangan;
        $bobot = (float)$request->bobot;
        if ($rules) {
            $updateData = $penilaian->where('id', $id)->update([
                'kriteria_id' => $kriteria_id,
                'keterangan' => $keterangan,
                'bobot' => $bobot
            ]);
            if ($updateData) {
                return redirect()->route('penilaian.index')->with('success', '<strong>SUCCESS!</strong>, Data has been updated!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        $deleteData = $penilaian->find($penilaian->id)->delete();
        if ($deleteData) {
            return redirect()->route('penilaian.index')->withSuccess('<strong>SUCCESS!</strong>, Data has been deleted!');
        }
    }
}
