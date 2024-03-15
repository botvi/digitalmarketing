<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function showLoginForm(){
        $user = Auth::user();
        return view('auth.login', ['user' => $user]);
    }

    public function login(Request $request)
    {
        // Validasi data input
        if (Auth::attempt($request->only('email', 'password'))) {
            $role = Auth::user()->role;

            if ($role == 'user') {
                return redirect('/');
            } elseif ($role == 'admin') {
                Alert::success('Login sukses', 'Selamat datang di admin page.');
                return redirect('/dashboard');
            }
        }

        // Display SweetAlert on login failure
        Alert::error('Login Failed', 'Invalid username or password');

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Menghapus sesi autentikasi pengguna
        
        // Redirect ke halaman login setelah logout
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
