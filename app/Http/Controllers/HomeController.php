<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class HomeController extends Controller
{
    public function index()
    {
        // Alert::success('Success Title', 'Success Message');
        return view('Page.Dashboard.dashboard');
    }

  
}