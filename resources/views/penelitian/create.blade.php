@extends('layouts.app')

@section('content')
<h3>Form Penelitian untuk {{ $dosen->nama_dosen }}</h3>
<form action="{{ route('penelitian.store',$dosen->id) }}" method="POST">
    @csrf
    @for($i=0;$i<$jumlah;$i++)
    <div class="card p-3 mb-3">
        <h5>Penelitian ke-{{ $i+1 }}</h5>
        <input type="text" name="penelitian[{{ $i }}][nama_jurnal]" class="form-control mb-2" placeholder="Nama Jurnal">
        <input type="number" name="penelitian[{{ $i }}][tahun_terbit]" class="form-control mb-2" placeholder="Tahun Terbit">
        <select name="penelitian[{{ $i }}][jenis_publikasi]" class="form-control mb-2">
            <option value="Jurnal Nasional">Jurnal Nasional</option>
            <option value="Jurnal Internasional">Jurnal Internasional</option>
            <option value="PKM">PKM</option>
        </select>
        <input type="url" name="penelitian[{{ $i }}][link_jurnal]" class="form-control mb-2" placeholder="Link Jurnal">
    </div>
    @endfor
    <button class="btn btn-success">Simpan</button>
</form>
@endsection
