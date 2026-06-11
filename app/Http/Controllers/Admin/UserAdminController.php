<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller {

    public function index() {
        $users = User::withCount(['ratings','favoritReseps'])->latest()->paginate(15);
        return view('admin.user.index', compact('users'));
    }

    public function update(Request $request, User $user) {
        $request->validate(['name'=>'required|string','email'=>'required|email|unique:users,email,'.$user->id,'role'=>'required|in:user,admin']);
        $data = $request->only('name','email','role');
        if ($request->filled('password')) $data['password'] = Hash::make($request->password);
        $user->update($data);
        return back()->with('success','Pengguna diperbarui!');
    }

    public function destroy(User $user) {
        if ($user->id === auth()->id()) return back()->with('error','Tidak dapat menghapus akun sendiri.');
        $user->delete();
        return back()->with('success','Pengguna dihapus!');
    }
}
