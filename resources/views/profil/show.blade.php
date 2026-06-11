@extends('layouts.app')
@section('title','Profil Saya')
@section('content')
<div class="container" style="padding-top:50px;padding-bottom:60px;">
<style>
.profil-header{display:flex;gap:32px;align-items:flex-start;margin-bottom:40px;padding:32px;background:var(--dark-lighter);border:1px solid var(--glass-border);}
.profil-avatar{width:100px;height:100px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-size:36px;font-weight:700;color:var(--dark);flex-shrink:0;overflow:hidden;}
.profil-avatar img{width:100%;height:100%;object-fit:cover;}
.profil-info h2{font-family:'Playfair Display',serif;font-size:28px;}
.profil-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:32px;}
.pstat{background:var(--dark-lighter);border:1px solid var(--glass-border);padding:20px;text-align:center;}
.pstat-num{font-family:'Playfair Display',serif;font-size:32px;color:var(--gold);}
.pstat-label{font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--cream-semi);}
.aktivitas-item{border-bottom:1px solid var(--glass-border);padding:14px 0;display:flex;gap:14px;align-items:center;}
</style>
    <div class="profil-header">
        <div class="profil-avatar">
            @if($user->avatar)<img src="{{ $user->avatar }}" alt="{{ $user->name }}">
            @else{{ strtoupper(substr($user->name,0,1)) }}@endif
        </div>
        <div class="profil-info">
            <h2>{{ $user->name }}</h2>
            <p style="color:var(--cream-semi);font-size:14px;margin:4px 0;">{{ $user->email }}</p>
            @if($user->bio)<p style="color:var(--cream-semi);font-size:14px;margin-top:8px;line-height:1.6;">{{ $user->bio }}</p>@endif
            <div style="margin-top:14px;display:flex;gap:12px;">
                <a href="{{ route('profil.edit') }}" class="btn btn-outline btn-sm">Edit Profil</a>
                @if($user->isAdmin())<span class="badge badge-gold">Admin</span>@endif
            </div>
        </div>
    </div>

    <div class="profil-stats">
        <div class="pstat"><div class="pstat-num">{{ $user->favoritReseps->count() }}</div><div class="pstat-label">Favorit</div></div>
        <div class="pstat"><div class="pstat-num">{{ $user->ratings->count() }}</div><div class="pstat-label">Ulasan</div></div>
        <div class="pstat"><div class="pstat-num">{{ $user->ratings->avg('nilai') ? number_format($user->ratings->avg('nilai'),1) : '-' }}</div><div class="pstat-label">Rating Rata-rata</div></div>
    </div>

    <div style="background:var(--dark-lighter);border:1px solid var(--glass-border);padding:24px;">
        <div style="font-family:'Playfair Display',serif;font-size:20px;margin-bottom:16px;color:var(--gold);">Riwayat Aktivitas</div>
        @if($aktivitas->count())
        @foreach($aktivitas as $a)
        <div class="aktivitas-item">
            <div style="font-size:24px;"></div>
            <div>
                <div style="font-size:14px;">Memberi ulasan pada <a href="{{ route('resep.show',$a->resep->slug) }}" style="color:var(--gold)">{{ $a->resep->judul }}</a></div>
                <div style="font-size:12px;color:var(--cream-semi);">{{ str_repeat('★',$a->nilai) }} · {{ $a->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @endforeach
        @else
        <p style="color:var(--cream-semi);font-size:14px;">Belum ada aktivitas.</p>
        @endif
    </div>
</div>
@endsection
