<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Kategori;

class ResepAdminController extends Controller {

    public function index() {
        $reseps = Resep::with('kategori')->latest()->paginate(15);
        return view('admin.resep.index', compact('reseps'));
    }

    public function create() {
        $kategoris = Kategori::all();
        return view('admin.resep.form', compact('kategoris'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'judul'            => 'required|string|max:200',
            'kategori_id'      => 'required|exists:kategoris,id',
            'deskripsi'        => 'nullable|string',
            'asal_daerah'      => 'nullable|string|max:100',
            'waktu_memasak'    => 'nullable|integer',
            'porsi'            => 'nullable|integer',
            'tingkat_kesulitan'=> 'required|in:mudah,sedang,sulit',
            'bahan'            => 'nullable|string',
            'langkah'          => 'nullable|string',
            'gambar'           => 'nullable|string|max:255',
            'published'        => 'boolean',
        ]);

        $data['bahan']   = $request->bahan ? array_filter(array_map('trim', explode("\n", $request->bahan))) : [];
        $data['langkah'] = $request->langkah ? array_filter(array_map('trim', explode("\n", $request->langkah))) : [];
        $data['published'] = $request->boolean('published', true);

        Resep::create($data);
        return redirect()->route('admin.resep.index')->with('success','Resep berhasil ditambahkan!');
    }

    public function edit(Resep $resep) {
        $kategoris = Kategori::all();
        return view('admin.resep.form', compact('resep','kategoris'));
    }

    public function update(Request $request, Resep $resep) {
        $data = $request->validate([
            'judul'            => 'required|string|max:200',
            'kategori_id'      => 'required|exists:kategoris,id',
            'deskripsi'        => 'nullable|string',
            'asal_daerah'      => 'nullable|string|max:100',
            'waktu_memasak'    => 'nullable|integer',
            'porsi'            => 'nullable|integer',
            'tingkat_kesulitan'=> 'required|in:mudah,sedang,sulit',
            'bahan'            => 'nullable|string',
            'langkah'          => 'nullable|string',
            'gambar'           => 'nullable|string|max:255',
        ]);

        $data['bahan']   = $request->bahan ? array_filter(array_map('trim', explode("\n", $request->bahan))) : [];
        $data['langkah'] = $request->langkah ? array_filter(array_map('trim', explode("\n", $request->langkah))) : [];
        $data['published'] = $request->boolean('published', true);

        $resep->update($data);
        return redirect()->route('admin.resep.index')->with('success','Resep berhasil diperbarui!');
    }

    public function destroy(Resep $resep) {
        $resep->delete();
        return back()->with('success','Resep berhasil dihapus!');
    }
}
