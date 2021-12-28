<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'siswa';
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Penilaian()
    {
        return $this->belongsToMany(Penilaian::class);
    }

    public function Penilaian_siswa()
    {
        return $this->hasOne(Penilaian_siswa::class);
    }

    public function Nilai()
    {
        return $this->hasOne(Nilai::class);
    }

    public function Kandidat()
    {
        return $this->hasMany(Kandidat::class);
    }
    public function Pilihan()
    {
        return $this->hasOne(Pilihan::class);
    }
}
