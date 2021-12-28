<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 5;
        $kriterias = Kriteria::paginate(5);
        return view('admin.kriteria.index', compact('kriterias'))->with('i', ($request->input('page', 1) - 1) * $paginate);
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
            'nama' => 'required',
            'sifat' => 'required',
            'bobot' => 'numeric|required',
        ]);
        if ($rules) {
            $createData = new Kriteria;
            $createData->nama = ucwords($request->nama);
            $createData->sifat = $request->sifat;
            $createData->bobot = $request->bobot;
            $createData->save();
            if ($createData) {
                return \redirect()->route('kriteria.index')->withSuccess('<strong>SUCCESS!</strong>, Data has been created!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kriteria = DB::table('kriteria')->where('id', $id)->first();
        return view('admin.kriteria.edit', ['kriteria' => $kriteria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $id = $request->id;
        $rules = $request->validate([
            'nama' => 'required',
            'sifat' => 'required'
        ]);
        if ($rules) {
            $updateData = Kriteria::find($id);
            $updateData->nama = $request->nama;
            $updateData->sifat = $request->sifat;
            $updateData->bobot = $request->bobot;
            $updateData->update();
            if ($updateData) {
                return redirect()->route('kriteria.index')->withSuccess('<strong>SUCCESS!</strong>, Data has been updated!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteData = kriteria::find($id)->delete();
        if ($deleteData) {
            return redirect()->route('kriteria.index')->with(['success' => '<strong>SUCCESS!</strong> Data has been deleted!']);
        }
    }
}
