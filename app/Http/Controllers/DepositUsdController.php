<?php

namespace App\Http\Controllers;

use App\Models\DepositUsd;
use Illuminate\Http\Request;
use App\Models\DaftarSaldo;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Auth;

class DepositUsdController extends Controller
{
    public function deposit_usd()
    {
        // Periksa apakah pengguna yang sedang login memiliki mata uang USD
        if (Auth::check() && Auth::user()->currency === 'USD') {
            $daftarSaldos = DaftarSaldo::all();
            return view('website.deposit_usd', compact('daftarSaldos'));
        } else {
            // Redirect pengguna ke halaman profil mereka jika mata uang tidak sesuai
            return redirect()->route('website.profil');
        }
    }

    public function deposit(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->selectedSaldo
                    ]
                ]
            ]
        ]);
        //dd($response);
        if(isset($response['id']) && $response['id']!=null) {
            foreach($response['links'] as $link) {
                if($link['rel'] === 'approve') {
                    
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('cancel');
        }
    }

    public function success(Request $request)
{
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();
    $response = $provider->capturePaymentOrder($request->token);
    // dd($response);

    if(isset($response['status']) && $response['status'] == 'COMPLETED') {
        // Mengakses nilai 'amount' dari respons PayPal
        $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];

        // Mengambil user yang sedang login
        $user = auth()->user();

        // Dapatkan nilai balance_usd saat ini dan tambahkan dengan amount
        $newBalance = $user->balance_usd + $amount;

        // Simpan nilai baru ke balance_usd user
        $user->update(['balance_usd' => $newBalance]);

        // Menambahkan awalan "USD" pada payment_id
        $paymentId = 'ENCPAY_' . $response['id'];

        // Menyimpan detail pembayaran ke dalam database
        DepositUsd::create([
            'user_id' => $user->id, // Mengambil ID pengguna yang sedang login
            'payment_id' => $paymentId, // ID pembayaran PayPal
            'amount' => $amount, // Jumlah pembayaran
            'payment_status' => $response['status'], // Status pembayaran
            'payment_method' => 'PayPal', // Metode pembayaran
        ]);

        // Meneruskan data yang diperlukan ke view 'website.invoiceusd'
        return view('website.invoice.invoiceusd')->with([
            'paymentId' => $paymentId,
            'userName' => $user->name,
            'paymentStatus' => $response['status'],
            'amount' => $amount,
            'paymentMethod' => 'PayPal',
            'currentDate' => now()->format('Y-m-d H:i:s'), // Tanggal saat ini
        ]);
    } else {
        return redirect()->route('cancel');
    }
}

    
    public function cancel()
    {
        return "Payment is cancelled.";
    }

}
