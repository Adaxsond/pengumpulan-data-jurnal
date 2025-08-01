<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $fillable = ['nama_dosen', 'nidn', 'prodi', 'jumlah_penelitian'];

    public function penelitian()
    {
        return $this->hasMany(Penelitian::class);
    }

    public function pkm()
    {
        return $this->hasMany(Pkm::class);
    }
}

