@extends('layouts.admin')
@section('title','Kelola Pengguna')
@section('content')
<div class="card">
    <table>
        <tr><th>Nama</th><th>Email</th><th>Role</th><th>Favorit</th><th>Ulasan</th><th>Bergabung</th><th>Aksi</th></tr>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td style="font-size:12px;">{{ $u->email }}</td>
            <td><span class="badge {{ $u->isAdmin() ? 'badge-gold':'badge-green' }}">{{ $u->role }}</span></td>
            <td>{{ $u->favorit_reseps_count }}</td>
            <td>{{ $u->ratings_count }}</td>
            <td style="font-size:12px;">{{ $u->created_at->format('d M Y') }}</td>
            <td>
                <button onclick="editUser({{ $u->id }},'{{ addslashes($u->name) }}','{{ $u->email }}','{{ $u->role }}')" class="btn btn-outline">Edit</button>
                @if($u->id !== auth()->id())
                <form method="POST" action="{{ route('admin.pengguna.destroy',$u) }}" style="display:inline" onsubmit="return confirm('Hapus pengguna ini?')">@csrf @method('DELETE')<button type="submit" class="btn btn-red">Hapus</button></form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    <div style="margin-top:16px;">{{ $users->links() }}</div>
</div>

<div id="editUserModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.8);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:var(--dark-lighter);border:1px solid var(--glass-border);padding:32px;width:420px;max-width:90vw;">
        <div style="font-family:'Playfair Display',serif;font-size:18px;color:var(--gold);margin-bottom:20px;">Edit Pengguna</div>
        <form method="POST" id="editUserForm">@csrf @method('PUT')
            <div class="form-group"><label class="form-label">Nama</label><input type="text" name="name" id="euName" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" id="euEmail" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Role</label><select name="role" id="euRole" class="form-input"><option value="user">User</option><option value="admin">Admin</option></select></div>
            <div class="form-group"><label class="form-label">Password Baru (kosongkan jika tidak diubah)</label><input type="password" name="password" class="form-input"></div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-gold">Perbarui</button>
                <button type="button" onclick="document.getElementById('editUserModal').style.display='none'" class="btn btn-outline">Batal</button>
            </div>
        </form>
    </div>
</div>
<script>
function editUser(id,name,email,role){
    document.getElementById('euName').value=name;
    document.getElementById('euEmail').value=email;
    document.getElementById('euRole').value=role;
    document.getElementById('editUserForm').action='/admin/pengguna/'+id;
    document.getElementById('editUserModal').style.display='flex';
}
</script>
@endsection
