@extends('layouts.app')
@section('title', $resep->judul)
@section('styles')
<style>
.hero-resep{position:relative;height:420px;overflow:hidden;}
.hero-resep img{width:100%;height:100%;object-fit:cover;}
.hero-resep-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(26,15,0,.95) 0%,rgba(26,15,0,.4) 60%,transparent 100%);}
.hero-resep-content{position:absolute;bottom:0;left:0;right:0;padding:40px;}
.hero-resep-content .container{max-width:900px;}
.info-grid{display:grid;grid-template-columns:2fr 1fr;gap:40px;margin-top:40px;}
.main-content{}
.sidebar{}
.meta-chips{display:flex;gap:12px;flex-wrap:wrap;margin:16px 0;}
.meta-chip{padding:6px 14px;background:rgba(201,168,76,.1);border:1px solid var(--glass-border);font-size:12px;color:var(--cream-semi);}
.bahan-list{list-style:none;margin-top:16px;}
.bahan-list li{padding:10px 0;border-bottom:1px solid var(--glass-border);font-size:14px;display:flex;align-items:center;gap:10px;}
.bahan-list li::before{content:'✦';color:var(--gold);font-size:10px;}
.langkah-list{list-style:none;margin-top:16px;}
.langkah-item{display:flex;gap:16px;margin-bottom:20px;}
.langkah-num{min-width:36px;height:36px;background:var(--gold);color:var(--dark);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;flex-shrink:0;}
.langkah-text{font-size:14px;line-height:1.7;padding-top:6px;}
.section-box{background:var(--dark-lighter);border:1px solid var(--glass-border);padding:24px;margin-bottom:20px;}
.section-box-title{font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);margin-bottom:14px;border-bottom:1px solid var(--glass-border);padding-bottom:10px;}
.star-input{display:flex;gap:6px;margin-bottom:14px;}
.star-btn{background:none;border:none;font-size:28px;color:#444;cursor:pointer;transition:color .2s;}
.star-btn:hover,.star-btn.active{color:var(--gold);}
.ulasan-item{border-bottom:1px solid var(--glass-border);padding:16px 0;}
.ulasan-item:last-child{border-bottom:none;}
.ulasan-user{font-weight:700;font-size:14px;color:var(--cream);}
.ulasan-stars{color:var(--gold);font-size:13px;margin:4px 0;}
.ulasan-text{font-size:14px;color:var(--cream-semi);line-height:1.6;}
.ulasan-date{font-size:11px;color:rgba(245,234,213,.4);margin-top:4px;}
.favorit-btn{width:100%;padding:12px;font-size:13px;letter-spacing:2px;text-transform:uppercase;font-weight:700;cursor:pointer;border:2px solid var(--gold);background:transparent;color:var(--gold);transition:all .3s;margin-bottom:14px;}
.favorit-btn:hover,.favorit-btn.active{background:var(--gold);color:var(--dark);}
.related-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:12px;}
.related-card{border:1px solid var(--glass-border);overflow:hidden;transition:border-color .2s;}
.related-card:hover{border-color:var(--gold);}
.related-img{width:100%;height:100px;object-fit:cover;}
.related-body{padding:10px;}
.related-title{font-size:13px;font-family:'Playfair Display',serif;}
@media(max-width:768px){.info-grid{grid-template-columns:1fr}.related-grid{grid-template-columns:1fr}}
</style>
@endsection
@section('content')
<!-- Hero -->
<div class="hero-resep">
    @if($resep->gambar)<img src="{{ $resep->gambar }}" alt="{{ $resep->judul }}">
    @else<div style="width:100%;height:100%;background:linear-gradient(135deg,#2a1b08,#3a2010);display:flex;align-items:center;justify-content:center;font-size:80px;">🍽️</div>@endif
    <div class="hero-resep-overlay"></div>
    <div class="hero-resep-content">
        <div class="container">
            <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:10px;">
                <a href="{{ route('beranda') }}" style="color:var(--gold)">Beranda</a> › <a href="{{ route('resep.index') }}" style="color:var(--gold)">Resep</a> › {{ $resep->judul }}
            </div>
            <h1 style="font-family:'Playfair Display',serif;font-size:clamp(24px,4vw,42px);margin-bottom:10px;">{{ $resep->judul }}</h1>
            <div style="display:flex;gap:16px;flex-wrap:wrap;font-size:13px;color:var(--cream-semi);">
                @if($resep->asal_daerah)<span>📍 {{ $resep->asal_daerah }}</span>@endif
                <span>⏱ {{ $resep->waktu_memasak ?? '?' }} menit</span>
                <span>🍽 {{ $resep->porsi ?? '?' }} porsi</span>
                <span>👁 {{ $resep->views }} dilihat</span>
                <span class="badge badge-gold">{{ ucfirst($resep->tingkat_kesulitan) }}</span>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="info-grid">
        <!-- MAIN -->
        <div class="main-content">
            @if($resep->deskripsi)
            <div class="section-box">
                <div class="section-box-title">Tentang Resep</div>
                <p style="font-size:15px;line-height:1.8;color:var(--cream-semi);">{{ $resep->deskripsi }}</p>
            </div>
            @endif

            @if($resep->bahan)
            <div class="section-box">
                <div class="section-box-title">🛒 Bahan-Bahan</div>
                <ul class="bahan-list">
                    @foreach($resep->bahan as $b)<li>{{ $b }}</li>@endforeach
                </ul>
            </div>
            @endif

            @if($resep->langkah)
            <div class="section-box">
                <div class="section-box-title">👨‍🍳 Cara Memasak</div>
                <div class="langkah-list">
                    @foreach($resep->langkah as $i=>$l)
                    <div class="langkah-item">
                        <div class="langkah-num">{{ $i+1 }}</div>
                        <div class="langkah-text">{{ $l }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- RATING & ULASAN -->
            <div class="section-box">
                <div class="section-box-title">⭐ Rating & Ulasan ({{ $resep->ratings->where('approved',true)->count() }})</div>
                @auth
                <form method="POST" action="{{ route('rating.store') }}" style="margin-bottom:24px;">
                    @csrf
                    <input type="hidden" name="resep_id" value="{{ $resep->id }}">
                    <div style="margin-bottom:10px;font-size:13px;color:var(--cream-semi);">{{ $userRating ? 'Ubah ulasanmu:' : 'Berikan ulasanmu:' }}</div>
                    <div class="star-input" id="starInput">
                        @for($i=1;$i<=5;$i++)
                        <button type="button" class="star-btn {{ $userRating && $userRating->nilai>=$i ? 'active' : '' }}" data-val="{{ $i }}" onclick="setRating({{ $i }})">★</button>
                        @endfor
                    </div>
                    <input type="hidden" name="nilai" id="nilaiInput" value="{{ $userRating->nilai ?? '' }}" required>
                    <textarea name="komentar" rows="3" placeholder="Tulis komentar (opsional)..." class="filter-input" style="width:100%;resize:vertical;margin-bottom:10px;">{{ $userRating->komentar ?? '' }}</textarea>
                    <button type="submit" class="btn btn-gold">{{ $userRating ? 'Perbarui Ulasan' : 'Kirim Ulasan' }}</button>
                </form>
                @else
                <p style="font-size:14px;color:var(--cream-semi);margin-bottom:20px;"><a href="{{ route('login') }}" style="color:var(--gold)">Login</a> untuk memberikan ulasan.</p>
                @endauth

                @foreach($resep->ratings->where('approved',true) as $rt)
                <div class="ulasan-item">
                    <div style="display:flex;justify-content:space-between;align-items:start;">
                        <div>
                            <div class="ulasan-user">{{ $rt->user->name ?? 'Anonim' }}</div>
                            <div class="ulasan-stars">{{ str_repeat('★',$rt->nilai) }}{{ str_repeat('☆',5-$rt->nilai) }}</div>
                        </div>
                        @if(auth()->check() && (auth()->id()===$rt->user_id || auth()->user()->isAdmin()))
                        <form method="POST" action="{{ route('rating.destroy',$rt->id) }}">@csrf @method('DELETE')<button type="submit" class="btn btn-red btn-sm">Hapus</button></form>
                        @endif
                    </div>
                    @if($rt->komentar)<p class="ulasan-text">{{ $rt->komentar }}</p>@endif
                    <div class="ulasan-date">{{ $rt->created_at->format('d M Y') }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="sidebar">
            <!-- Favorit -->
            @auth
            <form method="POST" action="{{ $isFavorit ? route('favorit.destroy',$resep->id) : route('favorit.store') }}">
                @csrf
                @if($isFavorit)@method('DELETE')@else<input type="hidden" name="resep_id" value="{{ $resep->id }}">@endif
                <button type="submit" class="favorit-btn {{ $isFavorit ? 'active' : '' }}">
                    {{ $isFavorit ? '❤ Tersimpan di Favorit' : '♡ Simpan ke Favorit' }}
                </button>
            </form>
            @endauth

            <!-- Info -->
            <div class="section-box">
                <div class="section-box-title">ℹ Info Resep</div>
                <div style="display:grid;gap:10px;">
                    <div style="display:flex;justify-content:space-between;font-size:13px;"><span style="color:var(--cream-semi);">Kategori</span><span>{{ $resep->kategori->nama ?? '-' }}</span></div>
                    <div style="display:flex;justify-content:space-between;font-size:13px;"><span style="color:var(--cream-semi);">Asal Daerah</span><span>{{ $resep->asal_daerah ?? '-' }}</span></div>
                    <div style="display:flex;justify-content:space-between;font-size:13px;"><span style="color:var(--cream-semi);">Waktu Memasak</span><span>{{ $resep->waktu_memasak ?? '-' }} mnt</span></div>
                    <div style="display:flex;justify-content:space-between;font-size:13px;"><span style="color:var(--cream-semi);">Porsi</span><span>{{ $resep->porsi ?? '-' }}</span></div>
                    <div style="display:flex;justify-content:space-between;font-size:13px;"><span style="color:var(--cream-semi);">Kesulitan</span><span class="badge badge-gold">{{ ucfirst($resep->tingkat_kesulitan) }}</span></div>
                    <div style="display:flex;justify-content:space-between;font-size:13px;"><span style="color:var(--cream-semi);">Rating</span><span style="color:var(--gold);">★ {{ number_format($resep->rating_rata,1) }}/5</span></div>
                </div>
            </div>

            <!-- Resep Terkait -->
            @if($related->count())
            <div class="section-box">
                <div class="section-box-title">Resep Terkait</div>
                <div class="related-grid">
                    @foreach($related as $rel)
                    <a href="{{ route('resep.show',$rel->slug) }}" class="related-card" style="display:block;">
                        @if($rel->gambar)<img src="{{ $rel->gambar }}" alt="{{ $rel->judul }}" class="related-img">
                        @else<div class="related-img" style="background:#2a1b08;display:flex;align-items:center;justify-content:center;font-size:24px;">🍽️</div>@endif
                        <div class="related-body">
                            <div class="related-title">{{ $rel->judul }}</div>
                            <div style="font-size:11px;color:var(--gold);">★ {{ number_format($rel->rating_rata,1) }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
function setRating(val){
    document.getElementById('nilaiInput').value=val;
    document.querySelectorAll('.star-btn').forEach((b,i)=>{b.classList.toggle('active',i<val);});
}
</script>
@endsection
