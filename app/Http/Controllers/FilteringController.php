<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;

class FilteringController extends Controller
{
    public function indexByKategori($kategoriId) {
        $categories = \App\Models\Kategori::where('id', $kategoriId)->get();
        $produks = \App\Models\Produk::where('kategori_id', $kategoriId)->get();
        return view('Website.bykategori', compact('categories', 'produks'));
    }
    
    
    
}
