<?php

namespace App\Imports;

use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $valid = Validator::make($rows->toArray(), [
            '*.1' => 'unique:siswa,nis',
        ])->validate();

        foreach ($rows as $row) {
            Siswa::create([
                'user_id' => 1,
                'nis' => $row[1],
                'nama' => $row[2],
                'kelas' => $row[3],
                'tempat_lahir' => $row[4],
                'tanggal_lahir' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])),
                'jenis_kelamin' => $row[6],
                'alamat' => $row[7],
                'password' => Hash::make($row[1]),
            ]);
        }
    }


    public function model(array $row)
    {
        // return new Siswa([
        //     'user_id' => 1,
        //     'nis' => $row[1],
        //     'nama' => $row[2],
        //     'kelas' => $row[3],
        //     'tempat_lahir' => $row[4],
        //     'tanggal_lahir' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])),
        //     'jenis_kelamin' => $row[6],
        //     'alamat' => $row[7],
        //     'password' => Hash::make($row[1]),
        // ]);
    }
    public function uniqueBy()
    {
        return 'nis';
    }
}
