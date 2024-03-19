<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Setting;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WebsiteController extends Controller
{
    


    public function index()
    { $settings = Setting::all(); 
        $produks = Produk::with('kategori', 'subkategori')->get();
        $categories = Kategori::all();
        return view('Website.index', compact('categories','produks','settings'));
    }
    public function profil(){
        return view('Website.profil');
    }
  





    public function update(Request $request)
{
    $user = auth()->user();

    // Validasi data input
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Perbarui informasi pengguna
    $user->name = $request->name;
    $user->save();

    return redirect()->back()->with('success', 'Informasi profil berhasil diperbarui.');
}


public function updatePassword(Request $request)
{
    // Validasi data input
    $request->validate([
        'currentPassword' => 'required',
        'newPassword' => 'required|min:8',
        'confirmNewPassword' => 'required|same:newPassword',
    ]);

    // Ambil pengguna yang saat ini sedang diautentikasi
    $user = Auth::user();

    // Periksa apakah kata sandi saat ini cocok dengan yang diberikan
    if (!Hash::check($request->currentPassword, $user->password)) {
        return response()->json(['error' => 'Current password does not match.'], 422);
    }

    // Perbarui kata sandi pengguna
    $user->password = Hash::make($request->newPassword);
    $user->save();

    return response()->json(['message' => 'Password updated successfully.']);
}



public function deskripsi($id)
{
    // Mengambil data produk berdasarkan ID
    $produk = Produk::findOrFail($id);

    // Mengambil data kategori terkait berdasarkan kategori_id dari produk
    $kategori = Kategori::findOrFail($produk->kategori_id);

    // Mengembalikan tampilan dengan data produk dan kategori
    return view('Website.deskripsi', compact('produk', 'kategori'));
}

}
