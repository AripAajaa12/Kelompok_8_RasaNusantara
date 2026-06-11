<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller {

    public function show() {
        $user = Auth::user();
        $aktivitas = $user->ratings()->with('resep')->latest()->limit(10)->get();
        return view('profil.show', compact('user','aktivitas'));
    }

    public function edit() {
        return view('profil.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request) {
        $user = Auth::user();
        $request->validate([
            'name'     => 'required|string|min:3|max:100',
            'bio'      => 'nullable|string|max:500',
            'avatar'   => 'nullable|image|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only('name','bio');

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars','public');
            $data['avatar'] = '/storage/'.$path;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('profil.show')->with('success','Profil berhasil diperbarui!');
    }
}
