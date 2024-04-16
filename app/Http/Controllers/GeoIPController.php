<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Http;

class GeoIPController extends Controller
{
   
    public function currencyconvertbylokasi()
{
    $response = Http::get('https://api.currencybeacon.com/v1/convert', [
        'from' => 'RUB',
        'to' => 'IDR',
        'amount' => 919.10, // Jumlah yang ingin Anda konversi
        'api_key' => '1i4uihYk7lFb5JisqsMSrnckBKXhM2ul', // API Key Anda
    ]);

    if ($response->ok()) {
        $conversionValue = $response['response']['value'];

        return response()->json([
            'toCurrency' => 'IDR', // Mata uang yang diinginkan
            'fromCurrency' => 'RUB', // Mata uang asal
            'fromAmount' => 919.10,
            'convertedAmount' => $conversionValue
        ]);
    }

    return response()->json(['error' => 'Gagal untuk mengambil data konversi mata uang'], 500);
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
