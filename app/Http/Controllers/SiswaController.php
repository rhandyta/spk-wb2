<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\SiswaImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *@return \Illuminate\Contracts\Support\Renderable
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $siswa = Siswa::limit(10);
        if ($request->ajax()) {
            return DataTables()->of($siswa)
                ->addColumn('action', function ($data) {
                    $button = '<a href="/admin/siswa/' . $data->id . '" class="btn btn-primary btn-sm"> Detail</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="/admin/siswa/' . $data->id . '/edit" class="btn btn-success btn-sm"> Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                    return $button;
                })
                ->addColumn('siswa', function (Siswa $siswa) {
                    return $siswa->kelas;
                })
                ->addColumn('status', function (Siswa $siswa) {
                    if ($siswa->status == 0) {
                        return 'Tidak Anggota OSIS';
                    } elseif ($siswa->status == 1) {
                        return 'Anggota OSIS';
                    }
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.siswa.index');
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
            'user_id' => 'required',
            'kelas' => 'required',
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'status' => 'required',
            'password' => 'required|min:3',
            'photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        if ($rules) {
            $createData = new Siswa;
            $createData->user_id =   (int)$request->user_id;
            $createData->kelas =   strtoupper($request->kelas);
            $createData->nis = (int)$request->nis;
            $createData->nama =  strtoupper($request->nama);
            $createData->tempat_lahir = $request->tempat_lahir;
            $createData->tanggal_lahir = $request->tanggal_lahir;
            $createData->jenis_kelamin = $request->jenis_kelamin;
            $createData->alamat = $request->alamat;
            $createData->status = $request->status;
            $createData->password = Hash::make($request->password);
            $photo = $request->file('photo')->store('', 'google');
            $detail = Storage::disk('google')->getMetadata($photo);
            $createData->photo = ($detail['path']);
            $createData->save();




            // $createData->photo = md5($request->photo) . '.' . $request->photo->extension('photo');
            // $photo = $request->photo;
            // $extention = $photo->getClientOriginalExtension();
            // $fileName = $createData->photo;
            // $photo->move(\public_path('assets/images/siswa'), $fileName);
            // $photo = $fileName;
            if (count($request->all())) {
                return redirect()->route('siswa.index')->withSuccess('<strong>SUCCESS!</strong>, Data has been created!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $url = $siswa->photo;

        return view('admin.siswa.detail', compact('siswa', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $rules = $request->validate([
            'kelas' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $id = (int)$request->id;
        $kelas = strtoupper($request->kelas);
        $nis = $request->nis;
        $nama = strtoupper($request->nama);
        $tempat_lahir = $request->tempat_lahir;
        $tanggal_lahir = $request->tanggal_lahir;
        $jenis_kelamin = $request->jenis_kelamin;
        $alamat = $request->alamat;
        $status = $request->status;
        if ($request->password) {
            $password = Hash::make($request->password);
        }

        if ($request->photo) {
            $photo = $request->file('photo')->store('', 'google');
            $detail = Storage::disk('google')->getMetadata($photo);
            $path = ($detail['path']);
        }

        if ($rules) {
            $updateData = Siswa::find($id);
            $updateData->kelas = $kelas;
            $updateData->nis = $nis;
            $updateData->nama = $nama;
            $updateData->tempat_lahir = $tempat_lahir;
            $updateData->tanggal_lahir = $tanggal_lahir;
            $updateData->jenis_kelamin = $jenis_kelamin;
            $updateData->alamat = $alamat;
            $updateData->status = $status;
            if ($request->password) {
                $updateData->password = $password;
            }
            if ($request->photo) {
                $updateData->photo = $path;
            };
            $updateData->save();
            if ($updateData) {
                return  redirect()->route('siswa.index')->with('success', '<strong>SUCCESS</strong>, Data has been updated!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $deleteData = $siswa->find($siswa->id)->delete();
        if ($deleteData) {
            return response()->json($deleteData);
        }
    }

    public function importexcel(Request $request)
    {
        set_time_limit(0);
        $rules = $request->validate([
            'excel' => 'required|mimes:xls,xlsx'
        ]);
        if ($rules) {
            $excel = $request->file('excel');
            $name_file = rand() . $excel->getClientOriginalName();
            $excel->move('assets/siswa', $name_file);
            $import = Excel::import(new SiswaImport, public_path('/assets/siswa/' . $name_file));
            if ($import) {
                return redirect()->route('siswa.index')->withSuccess('<strong>SUCCESS</strong>, Berhasil diimport!');
            }
        }
    }

    public function exportexcel(Request $request)
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    public function deleteSiswa()
    {
        $deleteAllSiswa = DB::table('siswa');
        $deleteAllSiswa->delete();
        if ($deleteAllSiswa) {
            return redirect()->route('siswa.index')->with('success', '<strong>SUCCESS!</strong>, data has been deleted!');
        }
    }
}
