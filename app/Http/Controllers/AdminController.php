<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penelitian;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $dosen = Dosen::withCount('penelitian')->get();
        return view('admin.dashboard', compact('dosen'));
    }

    public function detail(Request $request, $id)
    {
        $dosen = Dosen::with(['penelitian', 'pkm'])->findOrFail($id);

        // Gabungkan kategori jurnal dan skema PKM
        $kategoriJurnal = \App\Models\Penelitian::select('jenis_publikasi')->distinct()->pluck('jenis_publikasi')->toArray();
        $kategoriPKM = \App\Models\Pkm::select('skema')->distinct()->pluck('skema')->toArray();
        $kategoriGabungan = array_merge(
            array_map(fn($k) => ['tipe' => 'jurnal', 'nama' => $k], $kategoriJurnal),
            array_map(fn($k) => ['tipe' => 'pkm', 'nama' => $k], $kategoriPKM)
        );

        $penelitian = collect();
        $pkm = collect();

        if ($request->filled('kategori')) {
            [$tipe, $nama] = explode('|', $request->kategori);
            if ($tipe === 'jurnal') {
                $penelitian = $dosen->penelitian()->where('jenis_publikasi', $nama)->get();
            } else {
                $pkm = $dosen->pkm()->where('skema', $nama)->get();
            }
        }

        return view('admin.detail', compact('dosen', 'kategoriGabungan', 'penelitian', 'pkm'));
    }

    public function deletePenelitian($id)
    {
        $p = Penelitian::findOrFail($id);
        $p->delete();
        return back()->with('success','Data masuk tempat pemulihan!');
    }

    public function recovery()
    {
        $penelitian = Penelitian::onlyTrashed()->get();
        return view('admin.recovery', compact('penelitian'));
    }

    public function restore($id)
    {
        $p = Penelitian::onlyTrashed()->findOrFail($id);
        $p->restore();
        return back()->with('success','Data berhasil dipulihkan!');
    }

    public function forceDelete($id)
    {
        $p = Penelitian::onlyTrashed()->findOrFail($id);
        if (Carbon::parse($p->deleted_at)->diffInDays(now()) >= 30) {
            $p->forceDelete();
            return back()->with('success','Data dihapus permanen!');
        }
        return back()->with('error','Data belum 30 hari dihapus!');
    }

    public function dashboard(Request $request)
    {
        // Ambil semua kategori jurnal & skema PKM unik
        $kategoriJurnal = \App\Models\Penelitian::select('jenis_publikasi')->distinct()->pluck('jenis_publikasi');
        $kategoriPKM = \App\Models\Pkm::select('skema')->distinct()->pluck('skema');

        // Query dosen beserta relasi
        $query = Dosen::with(['penelitian', 'pkm']);

        // Filter jika ada kategori jurnal
        if ($request->filled('kategori_jurnal')) {
            $query->whereHas('penelitian', function($q) use ($request) {
                $q->where('jenis_publikasi', $request->kategori_jurnal);
            });
        }

        // Filter jika ada kategori PKM
        if ($request->filled('kategori_pkm')) {
            $query->whereHas('pkm', function($q) use ($request) {
                $q->where('skema', $request->kategori_pkm);
            });
        }

        $dosen = $query->get();

        return view('admin.dashboard', compact('dosen', 'kategoriJurnal', 'kategoriPKM'));
    }
}

