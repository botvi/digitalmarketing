<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduk;

class AdminOrderController extends Controller
{
    public function adminorder(){
        $adminorder = OrderProduk::all();
        return view('Page.Order.show', compact('adminorder'));  
    }
    
}
