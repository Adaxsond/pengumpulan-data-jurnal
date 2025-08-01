<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dosen' => 'required',
            'nidn' => 'required|unique:dosen',
            'prodi' => 'required',
            'jumlah_penelitian' => 'required|integer|min:1|max:4'
        ]);

        $dosen = Dosen::create($validated);

        return redirect()->route('penelitian.create', $dosen);
    }

    public function createJurnal() {
        return view('dosen.form_jurnal');
    }

    public function storeJurnal(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required',
            'nidn' => 'required',
            'prodi' => 'required',
            'jurnal.*.judul_jurnal' => 'required',
            'jurnal.*.jenis_publikasi' => 'required',
            'jurnal.*.tahun_terbit' => 'required|numeric',
            'jurnal.*.nama_jurnal' => 'required',
            'jurnal.*.link_jurnal' => 'required',
        ]);

        $dosen = Dosen::firstOrCreate(
            ['nidn' => $request->nidn],
            [
                'nama_dosen' => $request->nama_dosen,
                'prodi' => $request->prodi,
                'jumlah_penelitian' => 0,
            ]
        );

        foreach ($request->jurnal as $j) {
            $dosen->penelitian()->create([
                'judul' => $j['judul_jurnal'],
                'jenis_publikasi' => $j['jenis_publikasi'],
                'tahun_terbit' => $j['tahun_terbit'],
                'nama_jurnal' => $j['nama_jurnal'],
                'link_jurnal' => $j['link_jurnal'],
            ]);
        }

        return redirect()->route('dosen.create.jurnal')->with('success', 'Data jurnal berhasil disimpan!');
    }

    public function createPKM() {
        return view('dosen.form_pkm');
    }

    public function storePKM(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required',
            'nidn' => 'required',
            'prodi' => 'required',
            'pkm.*.judul_pkm' => 'required',
            'pkm.*.skema_pkm' => 'required',
            'pkm.*.tahun_kegiatan' => 'required|numeric',
            'pkm.*.foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dosen = Dosen::firstOrCreate(
            ['nidn' => $request->nidn],
            [
                'nama_dosen' => $request->nama_dosen,
                'prodi' => $request->prodi,
                'jumlah_penelitian' => 0,
            ]
        );

        foreach ($request->pkm as $i => $p) {
            $fotoPath = null;
            if (isset($p['foto']) && $p['foto']) {
                $fotoPath = $p['foto']->store('pkm_foto', 'public');
            }
            $dosen->pkm()->create([
                'judul' => $p['judul_pkm'],
                'skema' => $p['skema_pkm'],
                'tahun' => $p['tahun_kegiatan'],
                'mitra' => $p['mitra'] ?? null,
                'lokasi' => $p['lokasi_kegiatan'] ?? null,
                'foto' => $fotoPath,
            ]);
        }

        return redirect()->route('dosen.create.pkm')->with('success', 'Data PKM berhasil disimpan!');
    }
}
