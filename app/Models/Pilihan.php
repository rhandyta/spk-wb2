<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
    use HasFactory;
    protected $table = 'pilihan';
    protected $guarded = [];

    public function Kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
