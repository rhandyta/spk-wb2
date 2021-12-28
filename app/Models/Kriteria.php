<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $guarded = [];


    public function Penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function Nilai()
    {
        return $this->hasOne(Nilai::class);
    }

    public function Penilaian_siswa()
    {
        return $this->hasOne(Penilaian_siswa::class);
    }
}
