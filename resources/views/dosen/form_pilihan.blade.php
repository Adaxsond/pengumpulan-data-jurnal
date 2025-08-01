
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Pilih Jenis Form</h3>
    <div class="mt-4">
        <a href="{{ route('dosen.create.jurnal') }}" class="btn btn-primary" style="width:200px;">Form Jurnal</a>
        <a href="{{ route('dosen.create.pkm') }}" class="btn btn-success" style="width:200px; margin-left:20px;">Form PKM</a>
    </div>
</div>
@endsection