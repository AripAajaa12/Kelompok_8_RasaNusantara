@extends('layouts.app')
@section('title','Beranda')
@section('styles')
<style>
.hero{position:relative;height:100vh;min-height:600px;display:flex;align-items:center;justify-content:center;overflow:hidden;}
.hero-bg{position:absolute;inset:0;background:linear-gradient(135deg,#1a0f00 0%,#2a1200 40%,#1a0f00 100%);}
.hero-pattern{position:absolute;inset:0;background-image:radial-gradient(circle at 20% 50%,rgba(201,168,76,.08) 0%,transparent 50%),radial-gradient(circle at 80% 20%,rgba(139,26,26,.15) 0%,transparent 40%);}
.hero-content{position:relative;text-align:center;max-width:700px;padding:0 24px;}
.hero-tagline{font-size:11px;letter-spacing:5px;text-transform:uppercase;color:var(--gold);margin-bottom:20px;}
.hero-title{font-family:'Playfair Display',serif;font-size:clamp(36px,6vw,68px);line-height:1.1;margin-bottom:20px;}
.hero-title span{color:var(--gold);display:block;font-style:italic;}
.hero-desc{font-size:16px;color:var(--cream-semi);line-height:1.8;margin-bottom:36px;}
.hero-actions{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;}
.hero-scroll{position:absolute;bottom:30px;left:50%;transform:translateX(-50%);font-size:11px;letter-spacing:3px;text-transform:uppercase;color:var(--cream-semi);animation:bounce 2s infinite;}
@keyframes bounce{0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(6px)}}
.stats-bar{background:var(--dark-lighter);border-top:1px solid var(--glass-border);border-bottom:1px solid var(--glass-border);}
.stats-inner{max-width:1280px;margin:0 auto;padding:24px;display:grid;grid-template-columns:repeat(4,1fr);gap:0;}
.stat-item{text-align:center;padding:16px;border-right:1px solid var(--glass-border);}
.stat-item:last-child{border-right:none;}
.stat-num{font-family:'Playfair Display',serif;font-size:32px;color:var(--gold);}
.stat-label{font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--cream-semi);margin-top:4px;}
.section{padding:80px 0;}
.resep-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;}
.resep-card{background:var(--dark-lighter);border:1px solid var(--glass-border);overflow:hidden;transition:all .3s;cursor:pointer;}
.resep-card:hover{border-color:var(--gold);transform:translateY(-4px);box-shadow:0 12px 40px rgba(201,168,76,.15);}
.card-img{width:100%;height:200px;object-fit:cover;display:block;}
.card-img-placeholder{width:100%;height:200px;background:linear-gradient(135deg,var(--dark-lighter),#3a2010);display:flex;align-items:center;justify-content:center;font-size:40px;}
.card-body{padding:18px;}
.card-kategori{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:8px;}
.card-title{font-family:'Playfair Display',serif;font-size:18px;margin-bottom:8px;line-height:1.3;}
.card-meta{display:flex;gap:14px;font-size:12px;color:var(--cream-semi);margin-top:10px;}
.card-rating{display:flex;align-items:center;gap:6px;font-size:12px;}
.kat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:16px;}
.kat-card{background:var(--dark-lighter);border:1px solid var(--glass-border);padding:28px 20px;text-align:center;transition:all .3s;cursor:pointer;}
.kat-card:hover{border-color:var(--gold);transform:translateY(-3px);}
.kat-icon{font-size:32px;margin-bottom:10px;}
.kat-nama{font-family:'Playfair Display',serif;font-size:16px;color:var(--cream);}
.kat-count{font-size:11px;color:var(--cream-semi);margin-top:4px;}
.feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:32px;}
.feature-item{text-align:center;padding:32px 24px;background:var(--dark-lighter);border:1px solid var(--glass-border);}
.feature-icon{font-size:36px;margin-bottom:16px;}
.feature-title{font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);margin-bottom:10px;}
.feature-desc{font-size:14px;color:var(--cream-semi);line-height:1.7;}
@media(max-width:768px){.stats-inner{grid-template-columns:repeat(2,1fr)}.feature-grid{grid-template-columns:1fr}}
</style>
@endsection
@section('content')
<!-- HERO -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-pattern"></div>
    <div class="hero-content">
        <div class="hero-tagline">✦ Warisan Kuliner Nusantara ✦</div>
        <h1 class="hero-title">Cita Rasa<span>Tanah Airku</span></h1>
        <p class="hero-desc">Temukan ribuan resep masakan Indonesia dari Sabang sampai Merauke. Dari dapur tradisional hingga kreasi modern.</p>
        <div class="hero-actions">
            <a href="{{ route('resep.index') }}" class="btn btn-gold">Jelajahi Resep</a>
            <a href="{{ route('pencarian') }}" class="btn btn-outline">Cari Berdasarkan Bahan</a>
        </div>
    </div>
    <div class="hero-scroll">↓ Gulir ke bawah</div>
</section>

<!-- STATS -->
<div class="stats-bar">
    <div class="stats-inner">
        <div class="stat-item"><div class="stat-num">{{ \App\Models\Resep::count() }}</div><div class="stat-label">Resep</div></div>
        <div class="stat-item"><div class="stat-num">{{ \App\Models\Kategori::count() }}</div><div class="stat-label">Kategori</div></div>
        <div class="stat-item"><div class="stat-num">{{ \App\Models\User::count() }}</div><div class="stat-label">Pengguna</div></div>
        <div class="stat-item"><div class="stat-num">{{ \App\Models\Rating::count() }}</div><div class="stat-label">Ulasan</div></div>
    </div>
</div>

<!-- RESEP TERBARU -->
<section class="section">
    <div class="container">
        <div class="section-title">Resep <span>Terbaru</span></div>
        <div class="gold-line"></div>
        <div class="resep-grid">
            @foreach(\App\Models\Resep::with(['kategori','ratings'])->where('published',true)->latest()->limit(8)->get() as $r)
            <a href="{{ route('resep.show', $r->slug) }}" class="resep-card">
                @if($r->gambar)
                    <img src="{{ $r->gambar }}" alt="{{ $r->judul }}" class="card-img">
                @else
                    <div class="card-img-placeholder">🍽️</div>
                @endif
                <div class="card-body">
                    <div class="card-kategori">{{ $r->kategori->nama ?? '' }}</div>
                    <div class="card-title">{{ $r->judul }}</div>
                    <div class="card-rating">
                        <span class="stars">★★★★★</span>
                        <span>{{ number_format($r->rating_rata,1) }} ({{ $r->ratings->count() }})</span>
                    </div>
                    <div class="card-meta">
                        @if($r->waktu_memasak)<span>⏱ {{ $r->waktu_memasak }} mnt</span>@endif
                        @if($r->porsi)<span>🍽 {{ $r->porsi }} porsi</span>@endif
                        <span class="badge badge-gold">{{ ucfirst($r->tingkat_kesulitan) }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:36px;">
            <a href="{{ route('resep.index') }}" class="btn btn-outline">Lihat Semua Resep</a>
        </div>
    </div>
</section>

<!-- KATEGORI -->
<section class="section" style="padding-top:0">
    <div class="container">
        <div class="section-title">Jelajahi <span>Kategori</span></div>
        <div class="gold-line"></div>
        <div class="kat-grid">
            @foreach(\App\Models\Kategori::withCount('reseps')->get() as $k)
            <a href="{{ route('kategori.show', $k->slug) }}" class="kat-card">
                <div class="kat-icon">{{ $k->icon ?? '🍴' }}</div>
                <div class="kat-nama">{{ $k->nama }}</div>
                <div class="kat-count">{{ $k->reseps_count }} resep</div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- FITUR UNGGULAN -->
<section class="section" style="padding-top:0">
    <div class="container">
        <div class="section-title">Fitur <span>Unggulan</span></div>
        <div class="gold-line"></div>
        <div class="feature-grid">
            <div class="feature-item">
                <div class="feature-icon">🔍</div>
                <div class="feature-title">Cari Berdasarkan Bahan</div>
                <div class="feature-desc">Masukkan bahan yang kamu punya, kami bantu temukan resep yang cocok.</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">❤️</div>
                <div class="feature-title">Simpan Favorit</div>
                <div class="feature-desc">Koleksi resep favoritmu dalam satu tempat, mudah diakses kapan saja.</div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">⭐</div>
                <div class="feature-title">Rating & Ulasan</div>
                <div class="feature-desc">Beri penilaian dan bagikan pengalamanmu memasak resep favorit.</div>
            </div>
        </div>
    </div>
</section>
@endsection
