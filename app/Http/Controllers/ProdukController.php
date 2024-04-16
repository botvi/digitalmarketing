<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\SubKategori;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProdukController extends Controller
{

   
public function getSubKategoris($kategori_id)
{
    $subKategoris = SubKategori::where('kategori_id', $kategori_id)->get();
    return response()->json($subKategoris);
}

    public function index()
{
    $produks = Produk::with('kategori', 'subkategori')->latest()->get();


    return view('Page.Produk.show', compact('produks'));
}


    

    public function create()
{
    $kategoris = Kategori::all();
    $subKategoris = SubKategori::all();
    return view('Page.Produk.form', compact('kategoris', 'subKategoris'));
}

public function store(Request $request)
{
    $request->validate([
        'kategori_id' => 'required',
        'subkategori_id' => 'required',
        'keterangan' => 'required',
        'deskripsi' => 'required',
        'produk' => 'required',
        'idr' => 'required|numeric|min:0',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    try {
        $idrPrice = $request->idr;

        // Make API request to convert IDR to USD
        $response = Http::get('https://api.currencybeacon.com/v1/convert', [
            'from' => 'IDR',
            'to' => 'USD',
            'amount' => $idrPrice,
            'api_key' => '1i4uihYk7lFb5JisqsMSrnckBKXhM2ul',
        ]);

        // Check if the API request was successful
        if ($response->successful()) {
            // Extract the conversion value from the response
            $conversionValue = $response['response']['value'] ?? null;

            if ($conversionValue !== null) {
                // Add the product with prices in IDR and USD to the database
                $product = Produk::create([
                    'kategori_id' => $request->kategori_id,
                    'subkategori_id' => $request->subkategori_id,
                    'keterangan' => $request->keterangan,
                    'deskripsi' => $request->deskripsi,
                    'produk' => explode(',', $request->produk), // Simpan produk sebagai array PHP
                    'idr' => $idrPrice,
                    'usd' => $conversionValue,
                ]);

                // Simpan setiap gambar yang diunggah
                $gambarPaths = [];
                foreach ($request->file('gambar') as $image) {
                    $imageName = $image->getClientOriginalName();
                    $imagePath = $image->store('gambarproduk', 'public');
                    $gambarPaths[] = $imagePath;
                }

                // Konversi array gambar menjadi JSON
                $gambarJson = json_encode($gambarPaths);

                // Simpan JSON gambar ke dalam kolom 'gambar' pada tabel 'produk'
                $product->gambar = $gambarJson;

                // Simpan perubahan ke database
                $product->save();

                Alert::success('Success', 'Produk berhasil ditambahkan.');
                return redirect()->route('produk.index');
            } else {
                // Handle the case where the conversion value is not available
                Alert::error('Error', 'Gagal menambahkan produk: Nilai konversi tidak tersedia.');
                return back();
            }
        } else {
            // Handle the case where the API request was not successful
            Alert::error('Error', 'Gagal menambahkan produk: Gagal mengonversi harga.');
            return back();
        }
    } catch (\Exception $e) {
        // Handle any other exceptions
        Alert::error('Error', 'Gagal menambahkan produk: ' . $e->getMessage());
        return back();
    }
}
 public function edit($id)
 {
     $produk = Produk::findOrFail($id);
     $kategoris = Kategori::all();
     $subkategoris = SubKategori::where('kategori_id', $produk->kategori_id)->get(); // Mengambil subkategori berdasarkan kategori produk yang dipilih
     return view('page.produk.edit', compact('produk', 'kategoris', 'subkategoris'));
 }

 public function update(Request $request, $id)
{
    $request->validate([
        'kategori_id' => 'required',
        'subkategori_id' => 'required',
        'keterangan' => 'required',
        'deskripsi' => 'required',
        'produk' => 'required',
        'idr' => 'required|numeric|min:0',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Updated validation rule for images
    ]);

    try {
        $idrPrice = $request->idr;

        // Make API request to convert IDR to USD
        $response = Http::get('https://api.currencybeacon.com/v1/convert', [
            'from' => 'IDR',
            'to' => 'USD',
            'amount' => $idrPrice,
            'api_key' => '1i4uihYk7lFb5JisqsMSrnckBKXhM2ul',
        ]);

        // Check if the API request was successful
        if ($response->successful()) {
            // Extract the conversion value from the response
            $conversionValue = $response['response']['value'] ?? null;

            if ($conversionValue !== null) {
                // Find the product
                $product = Produk::findOrFail($id);

                // Update the product details
                $product->kategori_id = $request->kategori_id;
                $product->subkategori_id = $request->subkategori_id;
                $product->keterangan = $request->keterangan;
                $product->deskripsi = $request->deskripsi;
                $product->idr = $idrPrice;
                $product->usd = $conversionValue;

                // Save the produk directly as array
                $product->produk = explode(',', $request->produk);

                // Delete old images
                if ($request->hasFile('gambar')) {
                    foreach (json_decode($product->gambar) as $oldImagePath) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }

                // Update and save new images
                $newImagePaths = [];
                foreach ($request->file('gambar') as $gambar) {
                    $newImagePath = $gambar->store('gambarproduk', 'public');
                    $newImagePaths[] = $newImagePath;
                }
                $product->gambar = json_encode($newImagePaths);

                $product->save();

                Alert::success('Success', 'Produk berhasil diperbarui.');
                return redirect()->route('produk.index');
            } else {
                // Handle the case where the conversion value is not available
                Alert::error('Error', 'Gagal memperbarui produk: Nilai konversi tidak tersedia.');
                return back();
            }
        } else {
            // Handle the case where the API request was not successful
            Alert::error('Error', 'Gagal memperbarui produk: Gagal mengonversi harga.');
            return back();
        }
    } catch (\Exception $e) {
        // Handle any other exceptions
        Alert::error('Error', 'Gagal memperbarui produk: ' . $e->getMessage());
        return back();
    }
}

 

public function destroy($id)
{
    try {
        $produk = Produk::findOrFail($id);

        // Hapus gambar produk dari direktori
        $gambarPaths = json_decode($produk->gambar, true);
        foreach ($gambarPaths as $gambarPath) {
            Storage::disk('public')->delete($gambarPath);
        }

        $produk->delete();

        Alert::success('Success', 'Produk berhasil dihapus.');
        return redirect()->route('produk.index');
    } catch (\Exception $e) {
        Alert::error('Error', 'Terjadi kesalahan saat menghapus produk.');
        return redirect()->back();
    }
}

 public function download($id)
{
    $produk = Produk::findOrFail($id);

    // Konten yang akan dimasukkan ke dalam file teks
    $fileContent = "Products Purchased:\n";
    foreach ($produk->produk as $produks) {
        $fileContent .= "- $produks\n";
    }

    // Buat nama file yang unik (contoh: produk_1.txt)
    $filename = 'produk_' . $produk->id . '.txt';

    // Set header untuk mengindikasikan bahwa ini adalah file teks yang akan diunduh
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Tulis konten ke file teks
    file_put_contents($filename, $fileContent);

    // Baca file teks dan kirimkan ke output
    readfile($filename);

    // Hapus file teks setelah diunduh
    unlink($filename);
}

 

}
