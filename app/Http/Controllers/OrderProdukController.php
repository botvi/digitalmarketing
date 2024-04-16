<?php
// app/Http/Controllers/OrderProdukController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\OrderProduk;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Support\Facades\Response;

class OrderProdukController extends Controller
{

    public function myorders()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();
        
        // Mengambil data order berdasarkan user_id yang login dan mengurutkannya berdasarkan suatu kolom, misalnya 'created_at'
        $orders = OrderProduk::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    
        return view('Website.order', compact('orders'));
    }
    
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
        'jumlah_stok' => 'required|integer|min:1', // Validasi jumlah stok yang ingin dibeli
    ]);

    // Ambil data produk dari database
    $product = Produk::findOrFail($request->product_id);

    // Tentukan jumlah stok yang ingin dibeli
    $jumlahStok = $request->jumlah_stok;

    // Validasi jumlah stok yang ingin dibeli dengan stok tersedia
    if ($jumlahStok > count($product->produk)) {
        // return redirect()->back()->with('error', 'Stok tidak mencukupi untuk melakukan pembelian.');
        Alert::error('Error', 'Insufficient stock to make a purchase.');
        return back();
    }

    // Ambil informasi user yang login
    $user = Auth::user();

    // Tentukan harga berdasarkan mata uang pengguna yang login
    $userCurrency = $user->currency;
    $price = ($userCurrency == 'IDR') ? $product->idr : $product->usd;

    // Cek apakah saldo mencukupi
    $balanceField = 'balance_' . strtolower($userCurrency);
    if ($user->$balanceField < ($price * $jumlahStok)) {
        // return redirect()->back()->with('error', 'Saldo tidak mencukupi untuk melakukan pembelian.');
        Alert::error('Error', 'Insufficient balance to make a purchase.');
        return back();
    }

    // Kurangi saldo pengguna
    $user->$balanceField -= ($price * $jumlahStok);
    $user->save();

    // Kurangi stok produk
    $produkTerbeli = array_slice($product->produk, 0, $jumlahStok); // Ambil sejumlah stok yang ingin dibeli
    $product->produk = array_slice($product->produk, $jumlahStok); // Hapus produk yang telah dibeli
    $product->save();

    // Simpan pembelian ke dalam tabel OrderProduk
    $order = new OrderProduk;
    $order->user_id = $user->id;
    $order->harga = $price * $jumlahStok; // Harga total berdasarkan jumlah stok yang dibeli
    $order->produk = json_encode($produkTerbeli); // Simpan produk yang dibeli ke OrderProduk

    // Accessing kategori nama_kategori through relation
    $order->nama_kategori = $product->kategori->nama_kategori; 

    $order->keterangan = $product->keterangan; // Simpan keterangan produk
    $order->save();

    Alert::success('success', 'Purchase successful.');
    return Redirect::route('order');
}



public function download($id)
{
    // Ambil data order berdasarkan ID
    $order = OrderProduk::findOrFail($id);
    $produk = json_decode($order->produk);

    $fileContent = "Products Purchased:\n";
    foreach ($produk as $product) {
        $fileContent .= "- $product\n";
    }

    $filename = 'produk_' . $order->id . '.txt';

    $headers = [
        'Content-Type' => 'text/plain',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    return Response::streamDownload(function () use ($fileContent) {
        echo $fileContent;
    }, $filename, $headers);
}

    
    
    
}
