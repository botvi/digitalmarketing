<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;


class SettingController extends Controller
{
    // Method untuk menampilkan semua data personals
    public function index()
    {
        $settings = Setting::all();
        return view('Page.Setting.show', compact('settings'));
    }
   

    // Method untuk menampilkan form tambah personal
    public function create()
    {
        return view('Page.Setting.form');
    }


    public function store(Request $request)
{
    $request->validate([
        'instagram' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'facebook' => 'nullable|string|max:255',
        'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    try {
        $kategori = Setting::create([
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'icon' => $request->file('icon')->store('icon', 'public'), // Menyimpan file ke direktori public/icon
        ]);
        Alert::success('Success', 'Setting berhasil ditambahkan.');

        return redirect()->route('setting.index');
    } catch (\Exception $e) {
        Alert::error('Error', 'Gagal menambahkan Setting: ' . $e->getMessage());
        return back();
    }
}
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('Page.Setting.edit', compact('setting'));
    }

    // Method untuk menyimpan perubahan pada data personal
    public function update(Request $request, $id)
    {
        $request->validate([
            'instagram' => 'nullable|string|max:255',
        'twitter' => 'nullable|string|max:255',
        'facebook' => 'nullable|string|max:255',
        'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        try {
            $kategori = Setting::findOrFail($id);
            
            // Jika ada gambar baru yang dipilih, simpan gambar baru dan hapus yang lama
            if ($request->hasFile('icon')) {
                Storage::disk('public')->delete($kategori->icon); // Hapus gambar lama
                $iconPath = $request->file('icon')->store('icon', 'public'); // Simpan gambar baru
                $kategori->icon = $iconPath;
            }
    
            $kategori->update([
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
            ]);
            Alert::success('Success', 'Setting berhasil diperbarui.');
    
            return redirect()->route('setting.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui Setting: ' . $e->getMessage());
            return back();
        }
    }

    // Method untuk menghapus data personal
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        return redirect()->route('setting.index')->with('success', 'Setting data has been deleted successfully!');
    }
}
