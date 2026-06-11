@extends('layouts.app')
@section('title','Resep Favorit Saya')
@section('styles')
<style>
.page-header{padding:50px 0 30px;}
.favorit-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;}
.fav-card{background:var(--dark-lighter);border:1px solid var(--glass-border);overflow:hidden;transition:all .3s;position:relative;}
.fav-card:hover{border-color:var(--gold);transform:translateY(-4px);}
.fav-img{width:100%;height:180px;object-fit:cover;}
.fav-body{padding:16px;}
.fav-delete{position:absolute;top:10px;right:10px;background:rgba(192,57,43,.8);border:none;color:#fff;width:30px;height:30px;cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;}
.fav-delete:hover{background:#c0392b;}
</style>
@endsection
@section('content')
<div class="container">
    <div class="page-header">
        <div class="section-title">Resep <span>Favorit</span> Saya</div>
        <div class="gold-line"></div>
        <p style="color:var(--cream-semi);font-size:14px;">{{ $favorits->count() }} resep tersimpan</p>
    </div>
    @if($favorits->count())
    <div class="favorit-grid">
        @foreach($favorits as $r)
        <div class="fav-card">
            <form method="POST" action="{{ route('favorit.destroy',$r->id) }}" style="position:absolute;top:10px;right:10px;z-index:10;">
                @csrf @method('DELETE')
                <button type="submit" class="fav-delete" onclick="return confirm('Hapus dari favorit?')">✕</button>
            </form>
            <a href="{{ route('resep.show',$r->slug) }}" style="display:block;">
                @if($r->gambar)<img src="{{ $r->gambar }}" alt="{{ $r->judul }}" class="fav-img">
                @else<div class="fav-img" style="background:linear-gradient(135deg,#2a1b08,#3a2010);display:flex;align-items:center;justify-content:center;font-size:40px;">🍽️</div>@endif
                <div class="fav-body">
                    <div style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;">{{ $r->kategori->nama ?? '' }}</div>
                    <div style="font-family:'Playfair Display',serif;font-size:17px;margin-bottom:8px;">{{ $r->judul }}</div>
                    <div style="font-size:12px;color:var(--gold);">★ {{ number_format($r->rating_rata,1) }}</div>
                    <div style="font-size:12px;color:var(--cream-semi);margin-top:6px;display:flex;gap:10px;">
                        @if($r->waktu_memasak)<span>⏱ {{ $r->waktu_memasak }} mnt</span>@endif
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align:center;padding:80px;color:var(--cream-semi);">
        <div style="font-size:60px;margin-bottom:16px;">❤️</div>
        <p style="font-size:18px;margin-bottom:8px;">Belum ada resep favorit</p>
        <a href="{{ route('resep.index') }}" class="btn btn-gold" style="margin-top:14px;display:inline-block;">Jelajahi Resep</a>
    </div>
    @endif
</div>
@endsection
