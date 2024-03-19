<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\SubKategori;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;

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
        'produk.*' => 'required',
        'idr' => 'required|numeric|min:0',
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
                Produk::create([
                    'kategori_id' => $request->kategori_id,
                    'subkategori_id' => $request->subkategori_id,
                    'keterangan' => $request->keterangan,
                    'deskripsi' => $request->deskripsi,
                    'produk' => $request->produk,
                    'idr' => $idrPrice,
                    'usd' => $conversionValue,
                ]);
    
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

 // Fungsi untuk menampilkan form edit
//  public function edit($id)
//  {
//      $produk = Produk::findOrFail($id);
//      $kategoris = Kategori::all();
//      $subkategoris = SubKategori::where('kategori_id', $produk->kategori_id)->get(); // Mengambil subkategori berdasarkan kategori produk yang dipilih
//      return view('page.produk.edit', compact('produk', 'kategoris', 'subkategoris'));
//  }

//  public function update(Request $request, $id)
// {
//     try {
//         $request->validate([
//             'kategori_id' => 'required',
//             'subkategori_id' => 'required',
//             'keterangan' => 'required',
//             'produk' => 'required',
//             'stok' => 'required|numeric',
//             'idr' => 'required|numeric',
//         ]);

//         $produk = Produk::findOrFail($id);

//         // Check if the IDR price has changed
//         if ($request->idr != $produk->idr) {
//             // Make API request to convert IDR to USD
//             $response = Http::get('https://api.currencybeacon.com/v1/convert', [
//                 'from' => 'IDR',
//                 'to' => 'USD',
//                 'amount' => $request->idr,
//                 'api_key' => '1i4uihYk7lFb5JisqsMSrnckBKXhM2ul',
//             ]);

//             // Check if the API request was successful
//             if ($response->successful()) {
//                 // Extract the conversion value from the response
//                 $conversionValue = $response['response']['value'] ?? null;

//                 if ($conversionValue !== null) {
//                     // Update the product with prices in IDR and USD
//                     $produk->update([
//                         'kategori_id' => $request->kategori_id,
//                         'subkategori_id' => $request->subkategori_id,
//                         'keterangan' => $request->keterangan,
//                         'produk' => $request->produk,
//                         'stok' => $request->stok,
//                         'idr' => $request->idr,
//                         'usd' => $conversionValue,
//                     ]);
//                 } else {
//                     // Handle the case where the conversion value is not available
//                     Alert::error('Error', 'Gagal memperbarui produk: Nilai konversi tidak tersedia.');
//                     return redirect()->back();
//                 }
//             } else {
//                 // Handle the case where the API request was not successful
//                 Alert::error('Error', 'Gagal memperbarui produk: Gagal mengonversi harga.');
//                 return redirect()->back();
//             }
//         } else {
//             // Update the product without converting the price
//             $produk->update($request->all());
//         }

//         Alert::success('Success', 'Produk berhasil diperbarui.');
//         return redirect()->route('produk.index');
//     } catch (\Exception $e) {
//         // Handle any other exceptions
//         Alert::error('Error', 'Terjadi kesalahan saat memperbarui produk: ' . $e->getMessage());
//         return redirect()->back();
//     }
// }

 public function destroy($id)
 {
     try {
         $produk = Produk::findOrFail($id);
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
