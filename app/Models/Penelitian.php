<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $table = 'penelitian';
    protected $fillable = [
        'dosen_id', 'judul', 'jenis_publikasi', 'tahun_terbit', 'nama_jurnal', 'link_jurnal'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}



