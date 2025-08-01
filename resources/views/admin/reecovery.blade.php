@extends('layouts.app')

@section('content')
<h3>Tempat Pemulihan Data</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Jurnal</th>
            <th>Tanggal Dihapus</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($penelitian as $p)
        <tr>
            <td>{{ $p->nama_jurnal }}</td>
            <td>{{ $p->deleted_at }}</td>
            <td>
                <form action="{{ route('admin.recovery.restore',$p->id) }}" method="POST" style="display:inline">
                    @csrf
                    <button class="btn btn-success btn-sm">Pulihkan</button>
                </form>
                <form action="{{ route('admin.recovery.force',$p->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus permanen?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus Permanen</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
