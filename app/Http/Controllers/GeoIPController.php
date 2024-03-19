<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Http;

class GeoIPController extends Controller
{
   
    public function currencyconvertbylokasi(Request $request)
    {
        $location = GeoIP::getLocation($request->ip());
        
        $toCurrency = $location->currency;

        $response = Http::get('https://api.currencybeacon.com/v1/convert', [
            'from' => 'IDR',
            'to' => $toCurrency,
            'amount' => 15000, 
            'api_key' => '1i4uihYk7lFb5JisqsMSrnckBKXhM2ul', 
        ]);

        if ($response->ok()) {
            $conversionValue = $response['response']['value'];

            return response()->json([
                'toCurrency' => $toCurrency,
                'fromCurrency' => 'IDR',
                'fromAmount' => 15000,
                'convertedAmount' => $conversionValue
            ]);
        }

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
