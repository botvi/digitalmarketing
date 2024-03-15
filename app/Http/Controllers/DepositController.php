<?php

namespace App\Http\Controllers;

use App\Models\DepositIrd;
use Illuminate\Http\Request;
use App\Models\Deposit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class DepositController extends Controller
{
    private $serverKey;
    private $clientKey;
    private $isSandbox;

    public function __construct()
    {
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        $this->clientKey = env('MIDTRANS_CLIENT_KEY');
        $this->isSandbox = env('MIDTRANS_IS_SANDBOX');
    }
    
    public function showDepositForm()
    {
        return view('deposit_form');
    }

    public function processDeposit(Request $request)
    {
        // Konfigurasi kredensial Midtrans
        $serverKey = $this->serverKey;
        $isSandbox = $this->isSandbox;

        // Informasi pembayaran
        $params = array(
            'transaction_details' => array(
                'order_id' => uniqid(),
                'gross_amount' => $request->amount,
            ),
        );

        // Buat pembayaran menggunakan Midtrans Snap
        $snapToken = $this->getSnapToken($serverKey, $isSandbox, $params);

        // Simpan informasi transaksi deposit ke database
        $deposit = new Deposit();
        $deposit->order_id = $params['transaction_details']['order_id'];
        $deposit->amount = $request->amount;
        $deposit->status = 'pending';
        $deposit->save();

        // Tampilkan popup pembayaran
        return view('payment_popup', compact('snapToken'));
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
            return $result->token;
        }

        curl_close($ch);
    }

    public function checkTransactionStatus($orderId)
    {
        // Konfigurasi kredensial Midtrans
        $serverKey = $this->serverKey;
        $isSandbox = $this->isSandbox;
    
        // Buat URL untuk mengambil status transaksi
        $url = $isSandbox ? "https://api.sandbox.midtrans.com/v2/$orderId/status" : "https://api.midtrans.com/v2/$orderId/status";
    
        // Buat request untuk mengambil status transaksi
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
        ])->get($url);
    
        // Cek jika respons berhasil
        if ($response->successful()) {
            $status = $response->json()['transaction_status'];
    
            // Ubah status transaksi di database
            $deposit = Deposit::where('order_id', $orderId)->first();
            if ($deposit) {
                $deposit->status = $status;
                $deposit->save();
            } else {
                // Penanganan jika transaksi tidak ditemukan di database
                // Misalnya, log pesan kesalahan
                Log::error("Transaksi dengan order ID $orderId tidak ditemukan di database.");
            }
    
            return response()->json(['message' => 'Status transaksi berhasil diperbarui.']);
        } else {
            // Penanganan jika terjadi kesalahan dalam mengambil status transaksi
            $errorCode = $response->status();
            return response()->json(['error' => "Gagal mengambil status transaksi. Kode kesalahan: $errorCode"], $errorCode);
        }
    }
    

}
