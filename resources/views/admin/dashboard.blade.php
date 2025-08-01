@extends('layouts.app')

@section('content')
<h3>Dashboard Admin</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Dosen</th>
            <th>NIDN</th>
            <th>Prodi</th>
            <th>Jurnal</th>
            <th>PKM</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dosen as $d)
        <tr>
            <td>{{ $d->nama_dosen }}</td>
            <td>{{ $d->nidn }}</td>
            <td>{{ $d->prodi }}</td>
            <td>
                @if($d->penelitian->count())
                    <ul>
                        @foreach($d->penelitian as $jurnal)
                            <li>{{ $jurnal->judul }} ({{ $jurnal->jenis_publikasi }})</li>
                        @endforeach
                    </ul>
                @else
                    <em>Tidak ada data</em>
                @endif
            </td>
            <td>
                @if($d->pkm->count())
                    <ul>
                        @foreach($d->pkm as $pkm)
                            <li>{{ $pkm->judul }} ({{ $pkm->skema }})</li>
                        @endforeach
                    </ul>
                @else
                    <em>Tidak ada data</em>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.dosen.detail',$d->id) }}" class="btn btn-info btn-sm">Lihat</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
