@extends('layouts.app')
@section('title','Edit Profil')
@section('content')
<div class="container" style="padding-top:50px;padding-bottom:60px;max-width:600px;">
<style>
.form-group{margin-bottom:20px;}
.form-label{display:block;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:8px;}
.form-input{width:100%;padding:12px 16px;background:rgba(0,0,0,.3);border:1px solid var(--glass-border);color:var(--cream);font-size:14px;font-family:'Lato',sans-serif;transition:border-color .2s;}
.form-input:focus{outline:none;border-color:var(--gold);}
.form-error{color:#e74c3c;font-size:12px;margin-top:4px;}
</style>
    <div class="section-title">Edit <span>Profil</span></div>
    <div class="gold-line"></div>

    <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data" style="background:var(--dark-lighter);border:1px solid var(--glass-border);padding:32px;margin-top:24px;">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-input">
            @error('name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Bio</label>
            <textarea name="bio" rows="4" class="form-input" style="resize:vertical;">{{ old('bio',$user->bio) }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Foto Profil</label>
            <input type="file" name="avatar" accept="image/*" class="form-input" style="padding:8px;">
        </div>
        <div class="form-group">
            <label class="form-label">Password Baru (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="form-input" placeholder="Password baru...">
            @error('password')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password baru...">
        </div>
        <div style="display:flex;gap:12px;">
            <button type="submit" class="btn btn-gold">Simpan Perubahan</button>
            <a href="{{ route('profil.show') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection
