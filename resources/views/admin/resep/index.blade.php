@extends('layouts.admin')
@section('title','Kelola Resep')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div></div>
    <a href="{{ route('admin.resep.create') }}" class="btn btn-gold">+ Tambah Resep</a>
</div>
<div class="card">
    <table>
        <tr><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Kesulitan</th><th>Views</th><th>Status</th><th>Aksi</th></tr>
        @foreach($reseps as $r)
        <tr>
            <td>@if($r->gambar)<img src="{{ $r->gambar }}" style="width:50px;height:40px;object-fit:cover;">@else–@endif</td>
            <td><a href="{{ route('resep.show',$r->slug) }}" style="color:var(--gold)" target="_blank">{{ Str::limit($r->judul,35) }}</a></td>
            <td>{{ $r->kategori->nama ?? '-' }}</td>
            <td><span class="badge badge-gold">{{ ucfirst($r->tingkat_kesulitan) }}</span></td>
            <td>{{ $r->views }}</td>
            <td><span class="badge {{ $r->published ? 'badge-green':'badge-red' }}">{{ $r->published ? 'Publik':'Draft' }}</span></td>
            <td style="display:flex;gap:6px;flex-wrap:wrap;">
                <a href="{{ route('admin.resep.edit',$r) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.resep.destroy',$r) }}" onsubmit="return confirm('Hapus resep ini?')">@csrf @method('DELETE')<button type="submit" class="btn btn-red">Hapus</button></form>
            </td>
        </tr>
        @endforeach
    </table>
    <div style="margin-top:16px;">{{ $reseps->links() }}</div>
</div>
@endsection
