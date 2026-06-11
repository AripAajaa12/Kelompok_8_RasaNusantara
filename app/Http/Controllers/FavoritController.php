<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller {

    public function index() {
        $favorits = Auth::user()->favoritReseps()->with(['kategori','ratings'])->latest()->get();
        return view('favorit.index', compact('favorits'));
    }

    public function store(Request $request) {
        $request->validate(['resep_id' => 'required|exists:reseps,id']);
        $user = Auth::user();
        if (!$user->favoritReseps()->where('resep_id',$request->resep_id)->exists()) {
            $user->favoritReseps()->attach($request->resep_id);
            return back()->with('success','Resep berhasil ditambahkan ke favorit!');
        }
        return back()->with('info','Resep sudah ada di favorit.');
    }

    public function destroy($resepId) {
        Auth::user()->favoritReseps()->detach($resepId);
        return back()->with('success','Resep dihapus dari favorit.');
    }
}
