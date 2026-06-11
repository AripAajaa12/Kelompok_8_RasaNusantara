@extends('layouts.admin')
@section('title','Kelola Kategori')
@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
    <!-- Form Tambah -->
    <div class="card">
        <div class="card-title">+ Tambah Kategori</div>
        <form method="POST" action="{{ route('admin.kategori.store') }}">
            @csrf
            <div class="form-group"><label class="form-label">Nama Kategori *</label><input type="text" name="nama" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Icon (Emoji)</label><input type="text" name="icon" class="form-input" placeholder="🍜"></div>
            <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="deskripsi" rows="3" class="form-input" style="resize:vertical;"></textarea></div>
            <div class="form-group"><label class="form-label">URL Gambar</label><input type="text" name="gambar" class="form-input"></div>
            <button type="submit" class="btn btn-gold">Simpan</button>
        </form>
    </div>
    <!-- List -->
    <div class="card">
        <div class="card-title">Semua Kategori ({{ $kategoris->count() }})</div>
        @foreach($kategoris as $k)
        <div style="border-bottom:1px solid var(--glass-border);padding:12px 0;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <div style="font-size:14px;font-weight:700;">{{ $k->icon ?? '' }} {{ $k->nama }}</div>
                <div style="font-size:11px;color:var(--cream-semi);">{{ $k->reseps_count }} resep</div>
            </div>
            <div style="display:flex;gap:6px;">
                <button onclick="editKategori({{ $k->id }},'{{ $k->nama }}','{{ $k->icon }}','{{ addslashes($k->deskripsi) }}','{{ $k->gambar }}')" class="btn btn-outline">Edit</button>
                <form method="POST" action="{{ route('admin.kategori.destroy',$k) }}" onsubmit="return confirm('Hapus kategori ini?')">@csrf @method('DELETE')<button type="submit" class="btn btn-red">Hapus</button></form>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.8);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:var(--dark-lighter);border:1px solid var(--glass-border);padding:32px;width:440px;max-width:90vw;">
        <div style="font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);margin-bottom:20px;">Edit Kategori</div>
        <form method="POST" id="editForm">@csrf @method('PUT')
            <div class="form-group"><label class="form-label">Nama *</label><input type="text" name="nama" id="editNama" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Icon</label><input type="text" name="icon" id="editIcon" class="form-input"></div>
            <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="deskripsi" id="editDesc" rows="3" class="form-input" style="resize:vertical;"></textarea></div>
            <div class="form-group"><label class="form-label">URL Gambar</label><input type="text" name="gambar" id="editGambar" class="form-input"></div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-gold">Perbarui</button>
                <button type="button" onclick="document.getElementById('editModal').style.display='none'" class="btn btn-outline">Batal</button>
            </div>
        </form>
    </div>
</div>
<script>
function editKategori(id,nama,icon,desc,gambar){
    document.getElementById('editNama').value=nama;
    document.getElementById('editIcon').value=icon;
    document.getElementById('editDesc').value=desc;
    document.getElementById('editGambar').value=gambar;
    document.getElementById('editForm').action='/admin/kategori/'+id;
    document.getElementById('editModal').style.display='flex';
}
</script>
@endsection
