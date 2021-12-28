<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Pilihan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PilihanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    /**
     * Display a listing of the resource.
     *@return \Illuminate\Contracts\Support\Renderable
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $i = 1;
        $kandidat = Kandidat::all();
        $query = DB::table('pilihan')->where('siswa_id', Auth::user()->id)->get();
        return view('siswa.index', compact('kandidat', 'query', 'i', $kandidat));
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
            'kandidat_id' => 'required|numeric',
            'siswa_id' => 'required|numeric|unique:pilihan,siswa_id'
        ]);

        if ($rules) {
            $saveData = Pilihan::create($request->all());
            if ($saveData) {
                return \redirect()->route('vote.index')->withSuccess('<strong>SUCCESS</strong>, Berhasil memilih!');
            }
        }
    }
}
