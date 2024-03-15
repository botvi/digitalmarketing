<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;



class KategoriController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();
        return view('Page.Kategori.show', compact('categories'));
    }

    public function create()
    {
        return view('Page.Kategori.form');
    }

    

    public function edit($id)
{
    $category = Kategori::findOrFail($id);
    return view('Page.Kategori.edit', compact('category'));
}

public function store(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|unique:kategoris|max:255',
        'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Menambahkan validasi untuk input file
    ]);

    try {
        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'icon' => $request->file('icon')->store('icon', 'public'), // Menyimpan file ke direktori public/icon
        ]);
        Alert::success('Success', 'Kategori berhasil ditambahkan.');

        return redirect()->route('categories.index');
    } catch (\Exception $e) {
        Alert::error('Error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        return back();
    }
}


   
public function update(Request $request, $id)
{
    $request->validate([
        'nama_kategori' => 'required|max:255',
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah menjadi nullable karena tidak wajib memilih gambar baru saat edit
    ]);

    try {
        $kategori = Kategori::findOrFail($id);
        
        // Jika ada gambar baru yang dipilih, simpan gambar baru dan hapus yang lama
        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($kategori->icon); // Hapus gambar lama
            $iconPath = $request->file('icon')->store('icon', 'public'); // Simpan gambar baru
            $kategori->icon = $iconPath;
        }

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
        Alert::success('Success', 'Kategori berhasil diperbarui.');

        return redirect()->route('categories.index');
    } catch (\Exception $e) {
        Alert::error('Error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        return back();
    }
}

public function destroy($id)
{
    try {
        $kategori = Kategori::findOrFail($id);
        
        // Hapus ikon dari direktori jika ada
        if ($kategori->icon) {
            Storage::disk('public')->delete($kategori->icon);        
        }

        $kategori->delete();

        Alert::success('Success', 'Kategori berhasil dihapus.');

        return redirect()->route('categories.index');
    } catch (\Exception $e) {
        Alert::error('Error', 'Gagal menghapus kategori: ' . $e->getMessage());
        return back();
    }
}

}
