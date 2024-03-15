<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarSaldo;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;

class DaftarSaldoController extends Controller
{

 
    public function index()
{
    $daftarsaldo = DaftarSaldo::all();

    return view('Page.DaftarSaldo.show', compact('daftarsaldo'));
}


    

    public function create()
{

    return view('Page.DaftarSaldo.form');
}
public function store(Request $request)
{
    $request->validate([
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
                DaftarSaldo::create([
                   
                    'idr' => $idrPrice,
                    'usd' => $conversionValue,
                ]);
    
                Alert::success('Success', 'Daftar saldo berhasil ditambahkan.');
                return redirect()->route('daftarsaldo.index');
            } else {
                // Handle the case where the conversion value is not available
                Alert::error('Error', 'Gagal menambahkan Daftar saldo: Nilai konversi tidak tersedia.');
                return back();
            }
        } else {
            // Handle the case where the API request was not successful
            Alert::error('Error', 'Gagal menambahkan Daftar saldo: Gagal mengonversi harga.');
            return back();
        }
    } catch (\Exception $e) {
        // Handle any other exceptions
        Alert::error('Error', 'Gagal menambahkan Daftar saldo: ' . $e->getMessage());
        return back();
    }
}

 // Fungsi untuk menampilkan form edit
 public function edit($id)
 {
     $daftarsaldo = DaftarSaldo::findOrFail($id);
     return view('page.DaftarSaldo.edit', compact('daftarsaldo'));
 }

 public function update(Request $request, $id)
{
    try {
        $request->validate([
          
            'idr' => 'required|numeric',
        ]);

        $daftarsaldo = DaftarSaldo::findOrFail($id);

        // Check if the IDR price has changed
        if ($request->idr != $daftarsaldo->idr) {
            // Make API request to convert IDR to USD
            $response = Http::get('https://api.currencybeacon.com/v1/convert', [
                'from' => 'IDR',
                'to' => 'USD',
                'amount' => $request->idr,
                'api_key' => '1i4uihYk7lFb5JisqsMSrnckBKXhM2ul',
            ]);

            // Check if the API request was successful
            if ($response->successful()) {
                // Extract the conversion value from the response
                $conversionValue = $response['response']['value'] ?? null;

                if ($conversionValue !== null) {
                    // Update the product with prices in IDR and USD
                    $daftarsaldo->update([
                      
                        'idr' => $request->idr,
                        'usd' => $conversionValue,
                    ]);
                } else {
                    // Handle the case where the conversion value is not available
                    Alert::error('Error', 'Gagal memperbarui Daftar saldo: Nilai konversi tidak tersedia.');
                    return redirect()->back();
                }
            } else {
                // Handle the case where the API request was not successful
                Alert::error('Error', 'Gagal memperbarui Daftar saldo: Gagal mengonversi harga.');
                return redirect()->back();
            }
        } else {
            // Update the product without converting the price
            $daftarsaldo->update($request->all());
        }

        Alert::success('Success', 'Daftar saldo berhasil diperbarui.');
        return redirect()->route('daftarsaldo.index');
    } catch (\Exception $e) {
        // Handle any other exceptions
        Alert::error('Error', 'Terjadi kesalahan saat memperbarui Daftar saldo: ' . $e->getMessage());
        return redirect()->back();
    }
}

 public function destroy($id)
 {
     try {
         $daftarsaldo = DaftarSaldo::findOrFail($id);
         $daftarsaldo->delete();
 
         Alert::success('Success', 'Daftar saldo berhasil dihapus.');
         return redirect()->route('daftarsaldo.index');
     } catch (\Exception $e) {
         Alert::error('Error', 'Terjadi kesalahan saat menghapus Daftar saldo.');
         return redirect()->back();
     }
 }


}
