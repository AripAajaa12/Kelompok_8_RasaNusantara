<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller {

    public function store(Request $request) {
        $request->validate([
            'resep_id' => 'required|exists:reseps,id',
            'nilai'    => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        Rating::updateOrCreate(
            ['user_id'=>Auth::id(),'resep_id'=>$request->resep_id],
            ['nilai'=>$request->nilai,'komentar'=>$request->komentar,'approved'=>true]
        );

        return back()->with('success','Ulasan berhasil disimpan!');
    }

    public function destroy($id) {
        $rating = Rating::findOrFail($id);
        if ($rating->user_id !== Auth::id() && !Auth::user()->isAdmin()) abort(403);
        $rating->delete();
        return back()->with('success','Ulasan berhasil dihapus.');
    }
}
