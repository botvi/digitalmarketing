<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Http;

class GeoIPController extends Controller
{
   
    public function currencyconvertbylokasi(Request $request)
    {
        // Mendapatkan lokasi dari GeoIP
        $location = GeoIP::getLocation($request->ip());
        
        // Mendapatkan currency dari respons GeoIP
        $toCurrency = $location->currency;

        // Mendapatkan jumlah IDR dari respons CurrencyBeacon
        $response = Http::get('https://api.currencybeacon.com/v1/convert', [
            'from' => 'IDR',
            'to' => $toCurrency,
            'amount' => 15000, // Ganti dengan jumlah IDR yang diinginkan
            'api_key' => '1i4uihYk7lFb5JisqsMSrnckBKXhM2ul', // Ganti dengan API key Anda
        ]);

        // Jika permintaan berhasil
        if ($response->ok()) {
            // Mendapatkan nilai konversi dari respons CurrencyBeacon
            $conversionValue = $response['response']['value'];

            // Mengembalikan respons JSON dengan semua nilai
            return response()->json([
                'toCurrency' => $toCurrency,
                'fromCurrency' => 'IDR',
                'fromAmount' => 15000, // Ganti dengan jumlah IDR yang diinginkan
                'convertedAmount' => $conversionValue
            ]);
        }

        // Jika terjadi kesalahan dalam permintaan API
        return response()->json(['error' => 'Failed to fetch currency conversion data'], 500);
    }

    public function checkLocation(Request $request)
{
    // Mendapatkan lokasi dari GeoIP
    $location = GeoIP::getLocation($request->ip());
    
    // Tentukan mata uang berdasarkan negara pengguna
    $currency = $location->country === 'ID' ? 'IDR' : 'USD';

    // Mengembalikan respons JSON dengan informasi IP dan mata uang
    return response()->json([
        'ip_address' => $request->ip(),
        'country' => $location->country,
        'currency' => $currency,
    ]);
}

}
