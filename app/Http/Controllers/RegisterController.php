<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Torann\GeoIP\Facades\GeoIP;


class RegisterController extends Controller
{
    /**
     * Menampilkan formulir registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
   
    public function register(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Mendapatkan lokasi berdasarkan IP
        $location = GeoIP::getLocation($request->ip());

        // Tentukan mata uang berdasarkan negara pengguna
        $currency = $location->country === 'ID' ? 'IDR' : 'USD';

        // Buat pengguna baru dengan mata uang yang dideteksi
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'currency' => $currency,
        ]);

        // Jika pembuatan pengguna berhasil
        if ($user) {
            // Redirect dengan pesan sukses menggunakan SweetAlert
            Alert::success('Success', 'Pendaftaran akun berhasil.');
            return redirect()->route('login');
        } else {
            // Jika terjadi kesalahan
            Alert::error('Error', 'Terjadi kesalahan saat mendaftarkan pengguna. Silakan coba lagi.');
            return redirect()->route('register');
        }
    }
}
