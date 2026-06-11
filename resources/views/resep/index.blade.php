@extends('layouts.app')
@section('title','Semua Resep')
@section('styles')
<style>
.page-header{padding:60px 0 40px;text-align:center;}
.resep-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;margin-top:32px;}
.resep-card{background:var(--dark-lighter);border:1px solid var(--glass-border);overflow:hidden;transition:all .3s;}
.resep-card:hover{border-color:var(--gold);transform:translateY(-4px);}
.card-img{width:100%;height:200px;object-fit:cover;}
.card-img-placeholder{width:100%;height:200px;background:linear-gradient(135deg,#2a1b08,#3a2010);display:flex;align-items:center;justify-content:center;font-size:40px;}
.card-body{padding:16px;}
.card-kat{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;}
.card-title{font-family:'Playfair Display',serif;font-size:17px;margin-bottom:8px;}
.card-rating{font-size:12px;color:var(--gold);margin-bottom:6px;}
.card-meta{font-size:12px;color:var(--cream-semi);display:flex;gap:10px;flex-wrap:wrap;}
.filter-bar{background:var(--dark-lighter);border:1px solid var(--glass-border);padding:20px;margin-bottom:24px;}
.filter-row{display:flex;gap:14px;flex-wrap:wrap;align-items:flex-end;}
.filter-group{display:flex;flex-direction:column;gap:6px;flex:1;min-width:160px;}
.filter-group label{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);}
.filter-input{background:rgba(0,0,0,.3);border:1px solid var(--glass-border);color:var(--cream);padding:8px 12px;font-size:13px;font-family:'Lato',sans-serif;}
.filter-input:focus{outline:none;border-color:var(--gold);}
.kat-pills{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px;}
.kat-pill{padding:6px 16px;font-size:11px;letter-spacing:2px;text-transform:uppercase;background:transparent;border:1px solid var(--glass-border);color:var(--cream-semi);cursor:pointer;text-decoration:none;transition:all .2s;}
.kat-pill:hover,.kat-pill.active{border-color:var(--gold);color:var(--gold);}
.pagination-wrap{display:flex;justify-content:center;gap:8px;margin-top:40px;}
.pagination-wrap a,.pagination-wrap span{padding:8px 14px;background:var(--dark-lighter);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;transition:all .2s;}
.pagination-wrap a:hover{border-color:var(--gold);color:var(--gold);}
.pagination-wrap .active span{border-color:var(--gold);color:var(--gold);}
</style>
@endsection
@section('content')
<div class="container">
    <div class="page-header">
        <div class="section-title">Koleksi <span>Resep Nusantara</span></div>
        <div class="gold-line" style="margin:12px auto 0;"></div>
    </div>

    <!-- Filter -->
    <div class="filter-bar">
        <form method="GET" action="{{ route('resep.index') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label>Cari Resep</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Nama resep, daerah..." class="filter-input">
                </div>
                <div class="filter-group">
                    <label>Cari Berdasarkan Bahan</label>
                    <input type="text" name="bahan" value="{{ request('bahan') }}" placeholder="Misal: santan, cabai..." class="filter-input">
                </div>
                <div class="filter-group" style="max-width:180px;">
                    <label>Kategori</label>
                    <select name="kategori" class="filter-input">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $k)
                        <option value="{{ $k->id }}" {{ request('kategori')==$k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group" style="max-width:160px;">
                    <label>Kesulitan</label>
                    <select name="kesulitan" class="filter-input">
                        <option value="">Semua</option>
                        <option value="mudah" {{ request('kesulitan')=='mudah'?'selected':'' }}>Mudah</option>
                        <option value="sedang" {{ request('kesulitan')=='sedang'?'selected':'' }}>Sedang</option>
                        <option value="sulit" {{ request('kesulitan')=='sulit'?'selected':'' }}>Sulit</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-gold" style="white-space:nowrap">🔍 Cari</button>
                @if(request()->anyFilled(['q','bahan','kategori','kesulitan']))
                    <a href="{{ route('resep.index') }}" class="btn btn-outline">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Kategori pills -->
    <div class="kat-pills">
        <a href="{{ route('resep.index') }}" class="kat-pill {{ !request('kategori') ? 'active' : '' }}">Semua</a>
        @foreach($kategoris as $k)
        <a href="{{ route('resep.index', ['kategori'=>$k->id]) }}" class="kat-pill {{ request('kategori')==$k->id ? 'active' : '' }}">{{ $k->icon ?? '' }} {{ $k->nama }}</a>
        @endforeach
    </div>

    @if($reseps->count())
    <p style="font-size:13px;color:var(--cream-semi);">Menampilkan {{ $reseps->firstItem() }}-{{ $reseps->lastItem() }} dari {{ $reseps->total() }} resep</p>
    <div class="resep-grid">
        @foreach($reseps as $r)
        <a href="{{ route('resep.show', $r->slug) }}" class="resep-card" style="display:block;">
            @if($r->gambar)<img src="{{ $r->gambar }}" alt="{{ $r->judul }}" class="card-img">
            @else<div class="card-img-placeholder">🍽️</div>@endif
            <div class="card-body">
                <div class="card-kat">{{ $r->kategori->nama ?? '' }} @if($r->asal_daerah)· {{ $r->asal_daerah }}@endif</div>
                <div class="card-title">{{ $r->judul }}</div>
                <div class="card-rating">★ {{ number_format($r->rating_rata,1) }} ({{ $r->ratings->count() }} ulasan)</div>
                <div class="card-meta">
                    @if($r->waktu_memasak)<span>⏱ {{ $r->waktu_memasak }} mnt</span>@endif
                    @if($r->porsi)<span>🍽 {{ $r->porsi }} porsi</span>@endif
                    <span class="badge badge-gold">{{ ucfirst($r->tingkat_kesulitan) }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="pagination-wrap">{{ $reseps->links('pagination::simple-tailwind') }}</div>
    @else
    <div style="text-align:center;padding:80px 0;color:var(--cream-semi);">
        <div style="font-size:48px;margin-bottom:16px;">🍽️</div>
        <p style="font-size:18px;margin-bottom:8px;">Resep tidak ditemukan</p>
        <p style="font-size:14px;">Coba kata kunci atau bahan yang berbeda</p>
        <a href="{{ route('resep.index') }}" class="btn btn-outline" style="margin-top:20px">Lihat Semua Resep</a>
    </div>
    @endif
</div>
@endsection
