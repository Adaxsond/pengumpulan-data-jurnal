@extends('layouts.app')

@section('content')
<h3>Form Dosen Jurnal</h3>
<form method="POST" action="{{ route('dosen.store.jurnal') }}">
    @csrf
    <div class="form-group">
        <label>Nama Dosen</label>
        <input type="text" name="nama_dosen" class="form-control" required>
    </div>
    <div class="form-group">
        <label>NIDN</label>
        <input type="text" name="nidn" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Prodi</label>
        <input type="text" name="prodi" class="form-control" required>
    </div>
    <hr>
    <div id="jurnal-wrapper">
        <div class="jurnal-item">
            <div class="form-group">
                <label>Judul Jurnal</label>
                <input type="text" name="jurnal[0][judul_jurnal]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jenis Publikasi</label>
                <select name="jurnal[0][jenis_publikasi]" class="form-control" required>
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="jurnal[0][tahun_terbit]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama Jurnal</label>
                <input type="text" name="jurnal[0][nama_jurnal]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Link Jurnal</label>
                <input type="text" name="jurnal[0][link_jurnal]" class="form-control" required>
            </div>
            <hr>
        </div>
    </div>
    <button type="button" id="add-jurnal" class="btn btn-secondary mb-3">Tambah Jurnal</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<script>
let jurnalIndex = 1;
document.getElementById('add-jurnal').onclick = function() {
    let wrapper = document.getElementById('jurnal-wrapper');
    let html = `
    <div class="jurnal-item">
        <div class="form-group">
            <label>Judul Jurnal</label>
            <input type="text" name="jurnal[${jurnalIndex}][judul_jurnal]" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jenis Publikasi</label>
            <select name="jurnal[${jurnalIndex}][jenis_publikasi]" class="form-control" required>
                <option value="Nasional">Nasional</option>
                <option value="Internasional">Internasional</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" name="jurnal[${jurnalIndex}][tahun_terbit]" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Jurnal</label>
            <input type="text" name="jurnal[${jurnalIndex}][nama_jurnal]" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Link Jurnal</label>
            <input type="text" name="jurnal[${jurnalIndex}][link_jurnal]" class="form-control" required>
        </div>
        <hr>
    </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
    jurnalIndex++;
};
</script>
@endsection