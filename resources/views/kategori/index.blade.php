@extends('layouts.app')

@section('title', 'Kategori Resep — RasaNusantara')

@section('styles')
<style>
.kategori-hero{text-align:center;padding:60px 0 40px;}
.kategori-hero h1{font-family:'Playfair Display',serif;font-size:42px;color:var(--cream);}
.kategori-hero h1 span{color:var(--gold);}
.kategori-hero p{color:var(--cream-semi);font-size:15px;margin-top:10px;}

.kategori-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;padding-bottom:60px;}
@media(max-width:1024px){.kategori-grid{grid-template-columns:repeat(3,1fr);}}
@media(max-width:768px){.kategori-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:480px){.kategori-grid{grid-template-columns:1fr;}}

.kat-card{background:var(--dark-lighter);border:1px solid var(--glass-border);border-radius:4px;overflow:hidden;transition:transform .25s,border-color .25s;display:block;color:var(--cream);}
.kat-card:hover{transform:translateY(-6px);border-color:var(--gold);}

.kat-card-img{width:100%;height:160px;object-fit:cover;display:block;}
.kat-card-placeholder{width:100%;height:160px;background:rgba(201,168,76,.08);display:flex;align-items:center;justify-content:center;font-size:3rem;border-bottom:1px solid var(--glass-border);}

.kat-card-body{padding:16px;}
.kat-card-title{font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);margin-bottom:6px;}
.kat-card-desc{font-size:13px;color:var(--cream-semi);line-height:1.6;margin-bottom:12px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.kat-card-badge{display:inline-block;padding:3px 10px;font-size:10px;letter-spacing:1.5px;text-transform:uppercase;font-weight:700;background:rgba(201,168,76,.15);border:1px solid var(--gold);color:var(--gold);}
</style>
@endsection

@section('content')
<div class="container">

    <div class="kategori-hero">
        <h1>Kategori <span>Resep</span></h1>
        <div class="gold-line" style="margin:12px auto 0;"></div>
        <p>Jelajahi koleksi resep nusantara berdasarkan kategori masakan</p>
    </div>

    @if($kategoris->isEmpty())
        <div style="text-align:center;padding:60px 0;color:var(--cream-semi);">
            <p style="font-size:16px;">Belum ada kategori tersedia.</p>
        </div>
    @else
        <div class="kategori-grid">
            @foreach($kategoris as $kategori)
            <a href="{{ route('kategori.show', $kategori->slug) }}" class="kat-card">

                @if($kategori->gambar)
                    <img src="{{ asset($kategori->gambar) }}"
                         class="kat-card-img"
                         alt="{{ $kategori->nama }}">
                @else
                    <div class="kat-card-placeholder">
                        {{ $kategori->icon ?? '' }}
                    </div>
                @endif

                <div class="kat-card-body">
                    <div class="kat-card-title">{{ $kategori->nama }}</div>
                    @if($kategori->deskripsi)
                        <p class="kat-card-desc">{{ $kategori->deskripsi }}</p>
                    @endif
                    <span class="kat-card-badge">{{ $kategori->reseps_count }} Resep</span>
                </div>

            </a>
            @endforeach
        </div>
    @endif

</div>
@endsection
