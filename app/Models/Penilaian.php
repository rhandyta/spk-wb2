<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';
    protected $guaded = [];

    public function Kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function Siswa()
    {
        return $this->belongsToMany(Siswa::class);
    }

    public function Penilaian_siswa()
    {
        return $this->hasOne(Penilaian_siswa::class);
    }

    public function Nilai()
    {
        return $this->hasOne(Nilai::class);
    }
}
