<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepositIdr;
use App\Models\DepositUsd;

class HistoryController extends Controller
{
    public function history(Request $request)
{
    // Get the user ID of the logged-in user
    $userId = $request->user()->id;

    // Determine user's currency
    $currency = $request->user()->currency;

    // Retrieve history data based on user's currency and user ID, sorted by the latest created_at
    if ($currency === 'IDR') {
        $deposits = DepositIdr::where('payment_status', 'settlement')
                              ->where('user_id', $userId)
                              ->latest('created_at')
                              ->get();
    } elseif ($currency === 'USD') {
        $deposits = DepositUsd::where('payment_status', 'COMPLETED')
                              ->where('user_id', $userId)
                              ->latest('created_at')
                              ->get();
    } else {
        // Handle other currencies or no currency specified
        return response()->json(['error' => 'Invalid currency'], 400);
    }

    // Pass the retrieved data and the currency to the view
    return view('Website.history', compact('deposits', 'currency'));
}

    
    
}
