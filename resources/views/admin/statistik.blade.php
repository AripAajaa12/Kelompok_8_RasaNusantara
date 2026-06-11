@extends('layouts.admin')
@section('title','Statistik')
@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
    <div class="card">
        <div class="card-title"> Resep Terpopuler (by Views)</div>
        @foreach($resepTerpopuler as $i=>$r)
        <div style="border-bottom:1px solid var(--glass-border);padding:10px 0;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <span style="color:var(--gold);font-weight:700;margin-right:8px;">{{ $i+1 }}.</span>
                <a href="{{ route('resep.show',$r->slug) }}" style="color:var(--cream);font-size:13px;" target="_blank">{{ Str::limit($r->judul,30) }}</a>
                <div style="font-size:11px;color:var(--cream-semi);">{{ $r->kategori->nama ?? '' }}</div>
            </div>
            <span class="badge badge-gold">{{ $r->views }} views</span>
        </div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-title">🏷 Kategori Terfavorit</div>
        @foreach($kategoriFavorit as $k)
        <div style="border-bottom:1px solid var(--glass-border);padding:10px 0;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:13px;">{{ $k->icon ?? '' }} {{ $k->nama }}</span>
            <span class="badge badge-gold">{{ $k->reseps_count }} resep</span>
        </div>
        @endforeach
    </div>
</div>
<div class="card">
    <div class="card-title"> Aktivitas Pengguna</div>
    <table>
        <tr><th>Pengguna</th><th>Email</th><th>Ulasan Diberikan</th><th>Favorit Disimpan</th></tr>
        @foreach($aktivitasUser as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td style="font-size:12px;">{{ $u->email }}</td>
            <td>{{ $u->ratings_count }}</td>
            <td>{{ $u->favorit_reseps_count }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
