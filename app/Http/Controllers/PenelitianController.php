<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penelitian;
use Illuminate\Http\Request;

class PenelitianController extends Controller
{
    public function create(Dosen $dosen)
    {
        $jumlah = $dosen->jumlah_penelitian;
        return view('penelitian.create', compact('dosen','jumlah'));
    }

    public function store(Request $request, Dosen $dosen)
    {
        $request->validate([
            'penelitian.*.nama_jurnal' => 'required',
            'penelitian.*.tahun_terbit' => 'required|integer',
            'penelitian.*.jenis_publikasi' => 'required',
            'penelitian.*.link_jurnal' => 'required|url'
        ]);

        foreach ($request->penelitian as $data) {
            $data['dosen_id'] = $dosen->id;
            Penelitian::create($data);
        }

        return redirect('/form-dosen')->with('success','Data berhasil disimpan!');
    }
}

