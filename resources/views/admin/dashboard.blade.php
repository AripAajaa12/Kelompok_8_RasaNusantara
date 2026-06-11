@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="stats-grid">
    <div class="stat-box"><div class="num">{{ $stats['total_users'] }}</div><div class="lbl">Pengguna</div></div>
    <div class="stat-box"><div class="num">{{ $stats['total_reseps'] }}</div><div class="lbl">Resep</div></div>
    <div class="stat-box"><div class="num">{{ $stats['total_kategoris'] }}</div><div class="lbl">Kategori</div></div>
    <div class="stat-box"><div class="num">{{ $stats['total_ratings'] }}</div><div class="lbl">Ulasan</div></div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
    <div class="card">
        <div class="card-title"> Resep Terpopuler</div>
        <table>
            <tr><th>Resep</th><th>Kategori</th><th>Views</th></tr>
            @foreach($resepTerpopuler as $r)
            <tr>
                <td><a href="{{ route('resep.show',$r->slug) }}" style="color:var(--gold)">{{ Str::limit($r->judul,30) }}</a></td>
                <td>{{ $r->kategori->nama ?? '-' }}</td>
                <td>{{ $r->views }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="card">
        <div class="card-title"> Pengguna Terbaru</div>
        <table>
            <tr><th>Nama</th><th>Role</th><th>Bergabung</th></tr>
            @foreach($userTerbaru as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td><span class="badge {{ $u->isAdmin() ? 'badge-gold':'badge-green' }}">{{ $u->role }}</span></td>
                <td>{{ $u->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
    <div class="card">
        <div class="card-title"> Ulasan Terbaru</div>
        @foreach($ratingTerbaru as $r)
        <div style="border-bottom:1px solid var(--glass-border);padding:10px 0;">
            <div style="font-size:13px;font-weight:700;">{{ $r->user->name ?? '-' }}</div>
            <div style="font-size:12px;color:var(--gold);">{{ str_repeat('★',$r->nilai) }} – {{ Str::limit($r->resep->judul ?? '',30) }}</div>
            @if($r->komentar)<div style="font-size:12px;color:var(--cream-semi);">{{ Str::limit($r->komentar,60) }}</div>@endif
        </div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-title">🏷 Kategori</div>
        @foreach($kategoriStats as $k)
        <div style="display:flex;justify-content:space-between;border-bottom:1px solid var(--glass-border);padding:8px 0;">
            <span style="font-size:13px;">{{ $k->icon ?? '' }} {{ $k->nama }}</span>
            <span class="badge badge-gold">{{ $k->reseps_count }} resep</span>
        </div>
        @endforeach
    </div>
</div>
@endsection
