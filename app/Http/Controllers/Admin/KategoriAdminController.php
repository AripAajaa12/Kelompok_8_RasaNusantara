<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriAdminController extends Controller {

    public function index() {
        $kategoris = Kategori::withCount('reseps')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request) {
        $request->validate(['nama'=>'required|string|max:100','icon'=>'nullable|string','deskripsi'=>'nullable|string','gambar'=>'nullable|string']);
        Kategori::create($request->only('nama','icon','deskripsi','gambar'));
        return back()->with('success','Kategori ditambahkan!');
    }

    public function update(Request $request, Kategori $kategori) {
        $request->validate(['nama'=>'required|string|max:100','icon'=>'nullable|string','deskripsi'=>'nullable|string','gambar'=>'nullable|string']);
        $kategori->update($request->only('nama','icon','deskripsi','gambar'));
        return back()->with('success','Kategori diperbarui!');
    }

    public function destroy(Kategori $kategori) {
        $kategori->delete();
        return back()->with('success','Kategori dihapus!');
    }
}
