<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resep;
use App\Models\Kategori;
use App\Models\Rating;

class DashboardController extends Controller {

    public function index() {
        $stats = [
            'total_users'   => User::where('role','user')->count(),
            'total_reseps'  => Resep::count(),
            'total_kategoris' => Kategori::count(),
            'total_ratings' => Rating::count(),
        ];
        $resepTerpopuler = Resep::with('kategori')->orderByDesc('views')->limit(5)->get();
        $userTerbaru     = User::latest()->limit(5)->get();
        $ratingTerbaru   = Rating::with(['user','resep'])->latest()->limit(5)->get();
        $kategoriStats   = Kategori::withCount('reseps')->orderByDesc('reseps_count')->get();

        return view('admin.dashboard', compact('stats','resepTerpopuler','userTerbaru','ratingTerbaru','kategoriStats'));
    }
}
