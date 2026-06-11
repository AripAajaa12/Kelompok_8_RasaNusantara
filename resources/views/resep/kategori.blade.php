@extends('layouts.app')
@section('title', 'Kategori '.$kategori->nama)
@section('content')
<div class="container" style="padding-top:40px;">
    <div style="margin-bottom:30px;">
        <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:10px;">
            <a href="{{ route('beranda') }}" style="color:var(--gold)">Beranda</a> › <a href="{{ route('resep.index') }}" style="color:var(--gold)">Resep</a> › {{ $kategori->nama }}
        </div>
        <div style="font-size:48px;margin-bottom:10px;">{{ $kategori->icon ?? '🍴' }}</div>
        <div class="section-title">Resep <span>{{ $kategori->nama }}</span></div>
        <div class="gold-line"></div>
        @if($kategori->deskripsi)<p style="color:var(--cream-semi);font-size:15px;max-width:600px;">{{ $kategori->deskripsi }}</p>@endif
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px;">
        <a href="{{ route('resep.index') }}" class="kat-pill">Semua Kategori</a>
        @foreach($kategoris as $k)
        <a href="{{ route('kategori.show',$k->slug) }}" class="kat-pill {{ $k->id===$kategori->id ? 'active' : '' }}">{{ $k->icon ?? '' }} {{ $k->nama }}</a>
        @endforeach
    </div>

    <style>
    .kat-pill{padding:6px 16px;font-size:11px;letter-spacing:2px;text-transform:uppercase;background:transparent;border:1px solid var(--glass-border);color:var(--cream-semi);cursor:pointer;text-decoration:none;transition:all .2s;display:inline-block;}
    .kat-pill:hover,.kat-pill.active{border-color:var(--gold);color:var(--gold);}
    .resep-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;}
    .resep-card{background:var(--dark-lighter);border:1px solid var(--glass-border);overflow:hidden;transition:all .3s;display:block;}
    .resep-card:hover{border-color:var(--gold);transform:translateY(-4px);}
    .card-img{width:100%;height:200px;object-fit:cover;}
    .card-body{padding:16px;}
    </style>

    @if($reseps->count())
    <div class="resep-grid">
        @foreach($reseps as $r)
        <a href="{{ route('resep.show',$r->slug) }}" class="resep-card">
            @if($r->gambar)<img src="{{ $r->gambar }}" alt="{{ $r->judul }}" class="card-img">
            @else<div class="card-img" style="background:linear-gradient(135deg,#2a1b08,#3a2010);display:flex;align-items:center;justify-content:center;font-size:40px;">🍽️</div>@endif
            <div class="card-body">
                <div style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;">{{ $r->asal_daerah ?? $kategori->nama }}</div>
                <div style="font-family:'Playfair Display',serif;font-size:17px;margin-bottom:8px;">{{ $r->judul }}</div>
                <div style="font-size:12px;color:var(--gold);">★ {{ number_format($r->rating_rata,1) }} ({{ $r->ratings->count() }})</div>
                <div style="font-size:12px;color:var(--cream-semi);display:flex;gap:10px;margin-top:8px;">
                    @if($r->waktu_memasak)<span>⏱ {{ $r->waktu_memasak }} mnt</span>@endif
                    <span class="badge badge-gold">{{ ucfirst($r->tingkat_kesulitan) }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div style="text-align:center;margin-top:30px;">{{ $reseps->links() }}</div>
    @else
    <div style="text-align:center;padding:60px;color:var(--cream-semi);">
        <div style="font-size:48px;margin-bottom:12px;">🍽️</div>
        <p>Belum ada resep untuk kategori ini.</p>
    </div>
    @endif
</div>
@endsection
