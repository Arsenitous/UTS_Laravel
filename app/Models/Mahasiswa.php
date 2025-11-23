<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'NIM',
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'jurusan',
        'angkatan'
    ];

    protected $table = 'mahasiswas';

      public function absensi()
    {
        return $this->hasMany(Absensi::class, 'mahasiswa_id');
    }

    public function login()
    {
        return $this->hasOne(\App\Models\Login::class, 'mahasiswa_id');
    }

}
