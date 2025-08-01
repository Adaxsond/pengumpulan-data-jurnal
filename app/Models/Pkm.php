<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pkm extends Model
{
    protected $table = 'pkm';
    protected $fillable = [
        'dosen_id', 'judul', 'skema', 'tahun', 'mitra', 'lokasi'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}