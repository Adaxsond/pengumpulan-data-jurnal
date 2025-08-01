@extends('layouts.app')

@section('content')
<h3>Form Data Dosen</h3>
<form action="{{ route('dosen.store') }}" method="POST">
    @csrf
    <label>Nama Dosen</label>
    <input type="text" name="nama_dosen" class="form-control" required>

    <label>NIDN</label>
    <input type="text" name="nidn" class="form-control" required>

    <label>Prodi</label>
    <input type="text" name="prodi" class="form-control" required>

    <label>Jumlah Penelitian</label>
    <select name="jumlah_penelitian" class="form-control">
        @for($i=1;$i<=4;$i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <br>
    <button class="btn btn-primary">Lanjut</button>
</form>
@endsection
