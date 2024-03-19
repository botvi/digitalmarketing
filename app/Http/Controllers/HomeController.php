<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrderProduk;
use App\Models\DepositUsd;
use App\Models\DepositIdr;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil jumlah user dengan role 'user'
        $userCount = User::where('role', 'user')->count();

         // Menghitung total harga orderProduk dengan mata uang USD
         $totalPriceUSD = OrderProduk::join('users', 'order_produk.user_id', '=', 'users.id')
         ->where('users.currency', 'USD')
         ->sum('order_produk.harga');

     // Menghitung total harga orderProduk dengan mata uang IDR
     $totalPriceIDR = OrderProduk::join('users', 'order_produk.user_id', '=', 'users.id')
         ->where('users.currency', 'IDR')
         ->sum('order_produk.harga');


        // Mengambil jumlah deposit dari DepositUsd
        $totalDepositUSD = DepositUsd::sum('amount');

        // Mengambil jumlah deposit dari DepositIdr
        $totalDepositIDR = DepositIdr::sum('amount');

        // Mengambil jumlah Produk
        $productCount = Produk::count();

        return view('Page.Dashboard.dashboard', [
            'userCount' => $userCount,
            'totalPriceUSD' => $totalPriceUSD,
            'totalPriceIDR' => $totalPriceIDR,
            'totalDepositUSD' => $totalDepositUSD,
            'totalDepositIDR' => $totalDepositIDR,
            'productCount' => $productCount,
        ]);
    }
}
