<?php
// app/Http/Controllers/OrderProdukController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\OrderProduk;
use Auth;

class OrderProdukController extends Controller
{
    public function show($id)
    {
        $product = Produk::findOrFail($id);
        $userCurrency = Auth::user()->currency;

        // Memilih harga berdasarkan mata uang pengguna yang login
        if ($userCurrency == 'IDR') {
            $price = $product->idr;
        } else {
            $price = $product->usd;
        }

        return view('Website.prosesorder', compact('product', 'price'));
    }
    
    public function confirm(Request $request)
    {
        // Validasi request
        $request->validate([
            'product_id' => 'required|exists:produks,id',
        ]);

        // Ambil data produk dari database
        $product = Produk::findOrFail($request->product_id);

        // Ambil informasi user yang login
        $user = Auth::user();

        // Tentukan harga berdasarkan mata uang pengguna yang login
        $userCurrency = $user->currency;
        $price = ($userCurrency == 'IDR') ? $product->idr : $product->usd;

        // Cek apakah saldo mencukupi
        $balanceField = 'balance_' . strtolower($userCurrency);
        if ($user->$balanceField < $price) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi untuk melakukan pembelian.');
        }

        // Kurangi saldo pengguna
        $user->$balanceField -= $price;
        $user->save();

        // Kurangi stok produk
        $product->stok--;
        $product->save();

        // Simpan pembelian ke dalam tabel OrderProduk
        $order = new OrderProduk;
        $order->user_id = $user->id;
        $order->produk_id = $product->id;
        $order->harga = $price;
        $order->save();

        return redirect()->back()->with('success', 'Pembelian berhasil.');
    }
}
