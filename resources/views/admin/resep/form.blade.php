@extends('layouts.admin')
@section('title', isset($resep) ? 'Edit Resep' : 'Tambah Resep')
@section('content')
<div class="card" style="max-width:800px;">
    <form method="POST" action="{{ isset($resep) ? route('admin.resep.update',$resep) : route('admin.resep.store') }}">
        @csrf
        @if(isset($resep)) @method('PUT') @endif
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group" style="grid-column:1/-1;">
                <label class="form-label">Judul Resep *</label>
                <input type="text" name="judul" value="{{ old('judul',$resep->judul ?? '') }}" class="form-input" required>
                @error('judul')<div style="color:#e74c3c;font-size:11px;margin-top:3px;">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Kategori *</label>
                <select name="kategori_id" class="form-input" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ (old('kategori_id',$resep->kategori_id ?? '')==$k->id) ? 'selected':'' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Asal Daerah</label>
                <input type="text" name="asal_daerah" value="{{ old('asal_daerah',$resep->asal_daerah ?? '') }}" class="form-input" placeholder="Misal: Padang, Sumatera Barat">
            </div>
            <div class="form-group">
                <label class="form-label">Waktu Memasak (menit)</label>
                <input type="number" name="waktu_memasak" value="{{ old('waktu_memasak',$resep->waktu_memasak ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label">Porsi</label>
                <input type="number" name="porsi" value="{{ old('porsi',$resep->porsi ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label">Tingkat Kesulitan *</label>
                <select name="tingkat_kesulitan" class="form-input" required>
                    @foreach(['mudah','sedang','sulit'] as $t)
                    <option value="{{ $t }}" {{ (old('tingkat_kesulitan',$resep->tingkat_kesulitan ?? 'sedang')==$t) ? 'selected':'' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label class="form-label">URL Gambar</label>
                <input type="text" name="gambar" value="{{ old('gambar',$resep->gambar ?? '') }}" class="form-input" placeholder="/images/menu/nama-file.jpg">
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="form-input" style="resize:vertical;">{{ old('deskripsi',$resep->deskripsi ?? '') }}</textarea>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label class="form-label">Bahan-Bahan (satu baris per bahan)</label>
                <textarea name="bahan" rows="8" class="form-input" style="resize:vertical;" placeholder="500g daging sapi&#10;3 siung bawang putih&#10;...">{{ old('bahan', isset($resep) ? implode("\n",$resep->bahan??[]) : '') }}</textarea>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
                <label class="form-label">Langkah Memasak (satu baris per langkah)</label>
                <textarea name="langkah" rows="8" class="form-input" style="resize:vertical;" placeholder="Haluskan bumbu&#10;Tumis hingga harum&#10;...">{{ old('langkah', isset($resep) ? implode("\n",$resep->langkah??[]) : '') }}</textarea>
            </div>
            <div class="form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="published" value="1" {{ (old('published',($resep->published ?? true)) ? 'checked':'' ) }}>
                    <span class="form-label" style="margin:0;">Publikasikan Resep</span>
                </label>
            </div>
        </div>
        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-gold">{{ isset($resep) ? 'Perbarui Resep' : 'Simpan Resep' }}</button>
            <a href="{{ route('admin.resep.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
