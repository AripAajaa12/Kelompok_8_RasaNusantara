<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('reseps')
            ->orderBy('nama')
            ->get();

        return view('kategori.index', compact('kategoris'));
    }
}
