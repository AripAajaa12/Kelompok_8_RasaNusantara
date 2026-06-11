@extends('layouts.app')
@section('title','Pencarian Resep')
@section('styles')
<style>
.search-hero{background:var(--dark-lighter);border-bottom:1px solid var(--glass-border);padding:60px 0 40px;text-align:center;}
.big-search{display:flex;max-width:700px;margin:24px auto 0;gap:0;}
.big-search input{flex:1;padding:16px 20px;background:rgba(0,0,0,.4);border:2px solid var(--gold);color:var(--cream);font-size:16px;font-family:'Lato',sans-serif;border-right:none;}
.big-search input:focus{outline:none;}
.big-search button{padding:16px 28px;background:var(--gold);color:var(--dark);font-weight:700;font-size:14px;border:2px solid var(--gold);cursor:pointer;}
.filter-row2{display:flex;gap:14px;flex-wrap:wrap;margin-top:16px;justify-content:center;}
.bahan-tags{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px;justify-content:center;}
.bahan-tag{padding:5px 14px;font-size:11px;border:1px solid var(--glass-border);color:var(--cream-semi);cursor:pointer;text-decoration:none;transition:all .2s;background:transparent;}
.bahan-tag:hover{border-color:var(--gold);color:var(--gold);}
.resep-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;margin-top:32px;}
.resep-card{background:var(--dark-lighter);border:1px solid var(--glass-border);overflow:hidden;transition:all .3s;display:block;}
.resep-card:hover{border-color:var(--gold);transform:translateY(-4px);}
.card-img{width:100%;height:180px;object-fit:cover;}
.card-body{padding:14px;}
</style>
@endsection
@section('content')
<div class="search-hero">
    <div class="section-title" style="text-align:center;">Cari <span>Resep</span></div>
    <div class="gold-line" style="margin:12px auto;"></div>
    <p style="color:var(--cream-semi);font-size:15px;">Fitur unggulan: Cari resep berdasarkan bahan yang kamu punya!</p>

    <form method="GET" action="{{ route('pencarian') }}" id="searchForm">
        <div class="big-search">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama resep, asal daerah...">
            <button type="submit">🔍 Cari</button>
        </div>
        <div class="filter-row2">
            <input type="text" name="bahan" value="{{ request('bahan') }}" placeholder="🥘 Cari berdasarkan bahan (misal: santan, cabai)..." style="padding:10px 16px;background:rgba(0,0,0,.3);border:1px solid var(--glass-border);color:var(--cream);font-size:14px;width:400px;max-width:100%;font-family:'Lato',sans-serif;" id="bahanInput">
            <select name="kategori" style="padding:10px 14px;background:rgba(0,0,0,.3);border:1px solid var(--glass-border);color:var(--cream);font-size:13px;font-family:'Lato',sans-serif;">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                <option value="{{ $k->id }}" {{ request('kategori')==$k->id ? 'selected':'' }}>{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="bahan-tags">
        <span style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);padding-top:4px;">Bahan Populer:</span>
        @foreach(['Santan','Cabai','Bawang Merah','Jahe','Kunyit','Tempe','Tahu','Daging Sapi','Ayam','Ikan'] as $b)
        <a href="#" class="bahan-tag" onclick="document.getElementById('bahanInput').value='{{ $b }}';document.getElementById('searchForm').submit();return false;">{{ $b }}</a>
        @endforeach
    </div>
</div>

<div class="container" style="padding-top:20px;padding-bottom:60px;">
    @if($reseps !== null)
        @if($reseps->count())
        <p style="font-size:13px;color:var(--cream-semi);margin-bottom:8px;">
            Ditemukan <strong style="color:var(--gold)">{{ $reseps->total() }}</strong> resep
            @if(request('q')) untuk "<strong>{{ request('q') }}</strong>"@endif
            @if(request('bahan')) dengan bahan "<strong>{{ request('bahan') }}</strong>"@endif
        </p>
        <div class="resep-grid">
            @foreach($reseps as $r)
            <a href="{{ route('resep.show',$r->slug) }}" class="resep-card">
                @if($r->gambar)<img src="{{ $r->gambar }}" alt="{{ $r->judul }}" class="card-img">
                @else<div class="card-img" style="background:linear-gradient(135deg,#2a1b08,#3a2010);display:flex;align-items:center;justify-content:center;font-size:36px;">🍽️</div>@endif
                <div class="card-body">
                    <div style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:4px;">{{ $r->kategori->nama ?? '' }}</div>
                    <div style="font-family:'Playfair Display',serif;font-size:16px;margin-bottom:6px;">{{ $r->judul }}</div>
                    <div style="font-size:11px;color:var(--cream-semi);">⏱ {{ $r->waktu_memasak ?? '?' }} mnt · 🍽 {{ $r->porsi ?? '?' }} porsi</div>
                    <div style="font-size:12px;color:var(--gold);margin-top:4px;">★ {{ number_format($r->rating_rata,1) }}</div>
                </div>
            </a>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:30px;">{{ $reseps->links() }}</div>
        @else
        <div style="text-align:center;padding:60px;color:var(--cream-semi);">
            <div style="font-size:48px;margin-bottom:16px;">🔍</div>
            <p style="font-size:18px;margin-bottom:8px;">Tidak ada resep ditemukan</p>
            <p style="font-size:14px;">Coba bahan atau kata kunci yang berbeda</p>
        </div>
        @endif
    @else
    <div style="text-align:center;padding:60px;color:var(--cream-semi);">
        <div style="font-size:48px;margin-bottom:12px;">👆</div>
        <p>Gunakan kotak pencarian di atas untuk menemukan resep</p>
    </div>
    @endif
</div>
@endsection
