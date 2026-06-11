<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;

class RatingAdminController extends Controller {

    public function index() {
        $ratings = Rating::with(['user','resep'])->latest()->paginate(20);
        return view('admin.rating.index', compact('ratings'));
    }

    public function destroy(Rating $rating) {
        $rating->delete();
        return back()->with('success','Ulasan dihapus!');
    }

    public function toggleApprove(Rating $rating) {
        $rating->update(['approved' => !$rating->approved]);
        return back()->with('success','Status ulasan diperbarui!');
    }
}
