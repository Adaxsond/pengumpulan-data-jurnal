
@extends('layouts.app')

@section('content')
<h3>Detail Dosen</h3>
<table class="table">
    <tr>
        <th>Nama</th>
        <td>{{ $dosen->nama_dosen }}</td>
    </tr>
    <tr>
        <th>NIDN</th>
        <td>{{ $dosen->nidn }}</td>
    </tr>
    <tr>
        <th>Prodi</th>
        <td>{{ $dosen->prodi }}</td>
    </tr>
</table>

{{-- Filter Kategori Gabungan --}}
<form method="GET" action="{{ route('admin.dosen.detail', $dosen->id) }}" class="mb-3">
    <div class="row">
        <div class="col-md-6">
            <select name="kategori" class="form-control">
                <option value="">-- Pilih Kategori Jurnal/PKM --</option>
                @foreach($kategoriGabungan as $kategori)
                    <option value="{{ $kategori['tipe'] }}|{{ $kategori['nama'] }}" {{ request('kategori') == $kategori['tipe'].'|'.$kategori['nama'] ? 'selected' : '' }}>
                        {{ ucfirst($kategori['tipe']) }} - {{ $kategori['nama'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>

{{-- Tampilkan Jurnal jika kategori jurnal dipilih --}}
@if(request('kategori') && Str::startsWith(request('kategori'), 'jurnal|'))
    <h4>Daftar Jurnal (Kategori: {{ explode('|', request('kategori'))[1] }})</h4>
    @if($penelitian->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tahun Terbit</th>
                <th>Nama Jurnal</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penelitian as $jurnal)
            <tr>
                <td>{{ $jurnal->judul }}</td>
                <td>{{ $jurnal->jenis_publikasi }}</td>
                <td>{{ $jurnal->tahun_terbit }}</td>
                <td>{{ $jurnal->nama_jurnal }}</td>
                <td>{{ $jurnal->link_jurnal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <em>Tidak ada data jurnal</em>
    @endif
@endif

{{-- Tampilkan PKM jika kategori pkm dipilih --}}
@if(request('kategori') && Str::startsWith(request('kategori'), 'pkm|'))
    <h4>Daftar PKM (Skema: {{ explode('|', request('kategori'))[1] }})</h4>
    @if($pkm->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Skema</th>
                <th>Tahun</th>
                <th>Mitra</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pkm as $item)
            <tr>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->skema }}</td>
                <td>{{ $item->tahun }}</td>
                <td>{{ $item->mitra }}</td>
                <td>{{ $item->lokasi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <em>Tidak ada data PKM</em>
    @endif
@endif
@endsection
