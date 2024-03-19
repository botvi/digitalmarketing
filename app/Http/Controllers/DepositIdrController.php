<?php

namespace App\Http\Controllers;

use App\Models\DepositIdr;
use Illuminate\Http\Request;
use App\Models\DaftarSaldo;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Auth;

class DepositIdrController extends Controller
{

    private $serverKey;
    private $clientKey;
    private $isSandbox;

    public function __construct()
    {
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        $this->clientKey = env('MIDTRANS_CLIENT_KEY');
        // $this->isSandbox = false; // Ubah menjadi false untuk tidak menggunakan sandbox
        $this->isSandbox = env('MIDTRANS_IS_SANDBOX');
    }


    public function deposit_idr()
    {
        // Periksa apakah pengguna yang sedang login memiliki mata uang USD
        if (Auth::check() && Auth::user()->currency === 'IDR') {
            $daftarSaldos = DaftarSaldo::all();
            return view('Website.deposit_idr', compact('daftarSaldos'));
        } else {
            // Redirect pengguna ke halaman profil mereka jika mata uang tidak sesuai
            return redirect()->route('website.profil');
        }
    }

    public function processDeposit(Request $request)
{
    // Konfigurasi kredensial Midtrans
    $serverKey = $this->serverKey;
    $isSandbox = $this->isSandbox;

    // Get the currently authenticated user
    $user = Auth::user();
    $userId = $user->id; // Assuming the user ID is stored in a column named 'id'

    // Get the selected amount from the request
    $selectedAmount = $request->selectedSaldo;

    // Generate a unique payment ID with "ENCPAY" prefix
    $paymentId = 'ENCPAY_' . uniqid();

    // Informasi pembayaran
    $params = array(
        'transaction_details' => array(
            'order_id' => $paymentId,
            'gross_amount' => $selectedAmount,
        ),
    );

    // Buat pembayaran menggunakan Midtrans Snap
    $snapToken = $this->getSnapToken($serverKey, $isSandbox, $params);

    // Simpan informasi transaksi deposit ke database
    $deposit = new DepositIdr();
    $deposit->payment_id = $paymentId;
    $deposit->amount = $selectedAmount;
    $deposit->payment_status = 'pending';
    $deposit->payment_method = 'Midtrans';
    $deposit->user_id = $userId; // Assign the user_id to the deposit
    $deposit->save();

    // Tampilkan popup pembayaran
    return view('Website.popupidr', compact('snapToken'));
}

    

    private function getSnapToken($serverKey, $isSandbox, $params)
{
    $url = $isSandbox ? 'https://app.sandbox.midtrans.com/snap/v1/transactions' : 'https://app.midtrans.com/snap/v1/transactions';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Basic ' . base64_encode($serverKey . ':')
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Error: ' . curl_error($ch);
    } else {
        $result = json_decode($response);
        if (isset($result->token)) {
            return $result->token;
        } else {
            // Handle the case when token property is not found in the response
            echo 'Error: Token property not found in the response';
        }
    }

    curl_close($ch);
}



public function checkTransactionStatus($paymentId)
{
    // Konfigurasi kredensial Midtrans
    $serverKey = $this->serverKey;
    $isSandbox = $this->isSandbox;

    // Buat URL untuk mengambil status transaksi
    $url = $isSandbox ? "https://api.sandbox.midtrans.com/v2/$paymentId/status" : "https://api.midtrans.com/v2/$paymentId/status";

    // Buat request untuk mengambil status transaksi
    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
    ])->get($url);

    // Cek jika respons berhasil
    if ($response->successful()) {
        $status = $response->json()['transaction_status'];

        // Ubah status transaksi di database
        $deposit = DepositIdr::where('payment_id', $paymentId)->first();
        if ($deposit) {
            $deposit->payment_status = $status;
            $deposit->save();

            // Jika transaksi telah diselesaikan (settled), update balance_idr
            if ($status === 'settlement') {
                $user = User::find($deposit->user_id);
                if ($user) {
                    // Retrieve current balance_idr and update it
                    $user->balance_idr += $deposit->amount;
                    $user->save();
                }
            }
        } else {
            // Penanganan jika transaksi tidak ditemukan di database
            // Misalnya, log pesan kesalahan
            Log::error("Transaksi dengan order ID $paymentId tidak ditemukan di database.");
        }

        return response()->json(['message' => 'Status transaksi berhasil diperbarui.']);
    } else {
        // Penanganan jika terjadi kesalahan dalam mengambil status transaksi
        $errorCode = $response->status();
        return response()->json(['error' => "Gagal mengambil status transaksi. Kode kesalahan: $errorCode"], $errorCode);
    }
}

public function invoiceird(){
return view('Website.Invoice.invoiceird');
}

}
