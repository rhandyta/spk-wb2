<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;
    protected $table = 'kandidat';
    protected $guarded = [];

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function Pilihan()
    {
        return $this->hasMany(Pilihan::class);
    }
}
