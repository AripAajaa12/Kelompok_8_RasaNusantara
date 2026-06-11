<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Kategori;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller {

    public function index(Request $request) {
        $query = Resep::with(['kategori','ratings'])->where('published', true);

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sq) use ($q) {
                $sq->where('judul','like',"%$q%")
                   ->orWhere('deskripsi','like',"%$q%")
                   ->orWhere('asal_daerah','like',"%$q%");
            });
        }
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }
        if ($request->filled('bahan')) {
            $bahan = $request->bahan;
            $query->where('bahan','like',"%$bahan%");
        }
        if ($request->filled('kesulitan')) {
            $query->where('tingkat_kesulitan', $request->kesulitan);
        }

        $reseps = $query->latest()->paginate(12)->withQueryString();
        $kategoris = Kategori::withCount('reseps')->get();
        return view('resep.index', compact('reseps','kategoris'));
    }

    public function show($slug) {
        $resep = Resep::with(['kategori','ratings.user','user'])->where('slug',$slug)->where('published',true)->firstOrFail();
        $resep->increment('views');

        $userRating = null;
        if (Auth::check()) {
            $userRating = Rating::where('user_id', Auth::id())->where('resep_id', $resep->id)->first();
        }

        $isFavorit = false;
        if (Auth::check()) {
            $isFavorit = Auth::user()->favoritReseps()->where('resep_id', $resep->id)->exists();
        }

        $related = Resep::with('ratings')->where('kategori_id',$resep->kategori_id)->where('id','!=',$resep->id)->where('published',true)->limit(4)->get();
        return view('resep.show', compact('resep','userRating','isFavorit','related'));
    }

    public function kategori($slug) {
        $kategori = Kategori::where('slug',$slug)->firstOrFail();
        $reseps = Resep::with(['kategori','ratings'])->where('kategori_id',$kategori->id)->where('published',true)->latest()->paginate(12);
        $kategoris = Kategori::withCount('reseps')->get();
        return view('resep.kategori', compact('kategori','reseps','kategoris'));
    }

    public function cari(Request $request) {
        $kategoris = Kategori::all();
        $reseps = null;
        if ($request->filled('q') || $request->filled('bahan') || $request->filled('kategori')) {
            $query = Resep::with(['kategori','ratings'])->where('published',true);
            if ($request->filled('q')) {
                $q = $request->q;
                $query->where(fn($sq) => $sq->where('judul','like',"%$q%")->orWhere('deskripsi','like',"%$q%")->orWhere('asal_daerah','like',"%$q%"));
            }
            if ($request->filled('bahan')) {
                $query->where('bahan','like','%'.$request->bahan.'%');
            }
            if ($request->filled('kategori')) {
                $query->where('kategori_id',$request->kategori);
            }
            $reseps = $query->latest()->paginate(12)->withQueryString();
        }
        return view('pencarian.index', compact('reseps','kategoris'));
    }
}
