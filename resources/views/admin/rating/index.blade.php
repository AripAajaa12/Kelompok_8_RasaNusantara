@extends('layouts.admin')
@section('title','Kelola Ulasan')
@section('content')
<div class="card">
    <table>
        <tr><th>Pengguna</th><th>Resep</th><th>Rating</th><th>Komentar</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
        @foreach($ratings as $r)
        <tr>
            <td>{{ $r->user->name ?? '-' }}</td>
            <td style="max-width:150px;"><a href="{{ $r->resep ? route('resep.show',$r->resep->slug) : '#' }}" style="color:var(--gold)" target="_blank">{{ Str::limit($r->resep->judul ?? '-',25) }}</a></td>
            <td style="color:var(--gold);">{{ str_repeat('★',$r->nilai) }}</td>
            <td style="max-width:200px;font-size:12px;">{{ Str::limit($r->komentar,50) ?: '-' }}</td>
            <td><span class="badge {{ $r->approved ? 'badge-green':'badge-red' }}">{{ $r->approved ? 'Disetujui':'Disembunyikan' }}</span></td>
            <td style="font-size:12px;">{{ $r->created_at->format('d M Y') }}</td>
            <td style="display:flex;gap:6px;flex-wrap:wrap;">
                <form method="POST" action="{{ route('admin.ulasan.toggle',$r) }}">@csrf @method('PATCH')<button type="submit" class="btn btn-outline" style="font-size:10px;">{{ $r->approved ? 'Sembunyikan':'Tampilkan' }}</button></form>
                <form method="POST" action="{{ route('admin.ulasan.destroy',$r) }}" onsubmit="return confirm('Hapus ulasan ini?')">@csrf @method('DELETE')<button type="submit" class="btn btn-red">Hapus</button></form>
            </td>
        </tr>
        @endforeach
    </table>
    <div style="margin-top:16px;">{{ $ratings->links() }}</div>
</div>
@endsection
