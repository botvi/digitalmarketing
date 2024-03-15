<?php

namespace App\Http\Controllers;

use App\Models\SubKategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Kategori;

class SubKategoriController extends Controller
{
    public function index()
    {
        $subKategoris = SubKategori::with('kategori')->get();
        return view('Page.subkategori.show', compact('subKategoris'));
    }


public function create()
{
    $categories = Kategori::all();
    return view('Page.subkategori.form', compact('categories'));
}

public function edit($id)
{
    $subKategori = SubKategori::findOrFail($id);
    $categories = Kategori::all();
    return view('Page.subkategori.edit', compact('subKategori', 'categories'));
}

    public function store(Request $request)
{
    $request->validate([
        'nama_sub_kategori' => 'required|max:255',
        'keterangan' => 'required|max:255',
        'kategori_id' => 'required|exists:kategoris,id', // Memastikan kategori_id yang diberikan benar-benar ada di tabel kategoris
    ]);

    try {
        SubKategori::create([
            'nama_sub_kategori' => $request->nama_sub_kategori,
            'keterangan' => $request->keterangan,
            'kategori_id' => $request->kategori_id,
        ]);
        Alert::success('Success', 'Subkategori berhasil ditambahkan.');

        return redirect()->route('subkategori.index');
    } catch (\Exception $e) {
        Alert::error('Error', 'Gagal menambahkan subkategori: ' . $e->getMessage());
        return back();
    }
}


public function update(Request $request, $id)
{
    $request->validate([
        'nama_sub_kategori' => 'required|max:255',
        'keterangan' => 'required|max:255',
        'kategori_id' => 'required|exists:kategoris,id', // Memastikan kategori_id yang diberikan benar-benar ada di tabel kategoris
    ]);

    try {
        $subKategori = SubKategori::findOrFail($id);
        $subKategori->update([
            'nama_sub_kategori' => $request->nama_sub_kategori,
            'keterangan' => $request->keterangan,
            'kategori_id' => $request->kategori_id,
        ]);
        Alert::success('Success', 'Subkategori berhasil diperbarui.');

        return redirect()->route('subkategori.index');
    } catch (\Exception $e) {
        Alert::error('Error', 'Gagal memperbarui subkategori: ' . $e->getMessage());
        return back();
    }
}

public function destroy($id)
{
    try {
        $subKategori = SubKategori::findOrFail($id);
        $subKategori->delete();
        Alert::success('Success', 'Subkategori berhasil dihapus.');
        return redirect()->route('subkategori.index');
    } catch (\Exception $e) {
        Alert::error('Error', 'Gagal menghapus subkategori: ' . $e->getMessage());
        return back();
    }
}
}
