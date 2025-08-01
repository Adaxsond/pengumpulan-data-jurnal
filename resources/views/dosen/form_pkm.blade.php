
@extends('layouts.app')

@section('content')
<h3>Form Dosen PKM</h3>
<form method="POST" action="{{ route('dosen.store.pkm') }}" enctype="multipart/form-data">
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
    <div id="pkm-wrapper">
        <div class="pkm-item">
            <div class="form-group">
                <label>Judul PKM</label>
                <input type="text" name="pkm[0][judul_pkm]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Skema PKM</label>
                <select name="pkm[0][skema_pkm]" class="form-control" required>
                    <option value="PKM-P">PKM-P</option>
                    <option value="PKM-M">PKM-M</option>
                    <option value="PKM-K">PKM-K</option>
                    <option value="PKM-T">PKM-T</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tahun Kegiatan</label>
                <input type="number" name="pkm[0][tahun_kegiatan]" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Mitra</label>
                <input type="text" name="pkm[0][mitra]" class="form-control">
            </div>
            <div class="form-group">
                <label>Lokasi Kegiatan</label>
                <input type="text" name="pkm[0][lokasi_kegiatan]" class="form-control">
            </div>
            <div class="form-group">
                <label>Pilih Input</label>
                <select name="pkm[0][input_type]" class="form-control input-type" required onchange="toggleInputType(this, 0)">
                    <option value="">-- Pilih --</option>
                    <option value="gambar">Upload Gambar</option>
                    <option value="jurnal">Input Link Jurnal</option>
                </select>
            </div>
            <div class="form-group input-gambar" id="input-gambar-0" style="display:none;">
                <label>Upload Foto</label>
                <input type="file" name="pkm[0][foto]" class="form-control" accept="image/*">
            </div>
            <div class="input-jurnal" id="input-jurnal-0" style="display:none;">
                <div class="form-group">
                    <label>Nama Jurnal</label>
                    <input type="text" name="pkm[0][nama_jurnal]" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="pkm[0][tahun_terbit]" class="form-control">
                </div>
                <div class="form-group">
                    <label>Jenis Publikasi</label>
                    <select name="pkm[0][jenis_publikasi]" class="form-control">
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Link Jurnal</label>
                    <input type="text" name="pkm[0][link_jurnal]" class="form-control">
                </div>
            </div>
            <hr>
        </div>
    </div>
    <button type="button" id="add-pkm" class="btn btn-secondary mb-3">Tambah PKM</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<script>
let pkmIndex = 1;
function toggleInputType(select, idx) {
    let val = select.value;
    document.getElementById('input-gambar-' + idx).style.display = (val === 'gambar') ? '' : 'none';
    document.getElementById('input-jurnal-' + idx).style.display = (val === 'jurnal') ? '' : 'none';
}
document.getElementById('add-pkm').onclick = function() {
    let wrapper = document.getElementById('pkm-wrapper');
    let html = `
    <div class="pkm-item">
        <div class="form-group">
            <label>Judul PKM</label>
            <input type="text" name="pkm[${pkmIndex}][judul_pkm]" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Skema PKM</label>
            <select name="pkm[${pkmIndex}][skema_pkm]" class="form-control" required>
                <option value="PKM-P">PKM-P</option>
                <option value="PKM-M">PKM-M</option>
                <option value="PKM-K">PKM-K</option>
                <option value="PKM-T">PKM-T</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tahun Kegiatan</label>
            <input type="number" name="pkm[${pkmIndex}][tahun_kegiatan]" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Mitra</label>
            <input type="text" name="pkm[${pkmIndex}][mitra]" class="form-control">
        </div>
        <div class="form-group">
            <label>Lokasi Kegiatan</label>
            <input type="text" name="pkm[${pkmIndex}][lokasi_kegiatan]" class="form-control">
        </div>
        <div class="form-group">
            <label>Pilih Input</label>
            <select name="pkm[${pkmIndex}][input_type]" class="form-control input-type" required onchange="toggleInputType(this, ${pkmIndex})">
                <option value="">-- Pilih --</option>
                <option value="gambar">Upload Gambar</option>
                <option value="jurnal">Input Link Jurnal</option>
            </select>
        </div>
        <div class="form-group input-gambar" id="input-gambar-${pkmIndex}" style="display:none;">
            <label>Upload Foto</label>
            <input type="file" name="pkm[${pkmIndex}][foto]" class="form-control" accept="image/*">
        </div>
        <div class="input-jurnal" id="input-jurnal-${pkmIndex}" style="display:none;">
            <div class="form-group">
                <label>Nama Jurnal</label>
                <input type="text" name="pkm[${pkmIndex}][nama_jurnal]" class="form-control">
            </div>
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="pkm[${pkmIndex}][tahun_terbit]" class="form-control">
            </div>
            <div class="form-group">
                <label>Jenis Publikasi</label>
                <select name="pkm[${pkmIndex}][jenis_publikasi]" class="form-control">
                    <option value="Nasional">Nasional</option>
                    <option value="Internasional">Internasional</option>
                </select>
            </div>
            <div class="form-group">
                <label>Link Jurnal</label>
                <input type="text" name="pkm[${pkmIndex}][link_jurnal]" class="form-control">
            </div>
        </div>
        <hr>
    </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
    pkmIndex++;
};
</script>
@endsection