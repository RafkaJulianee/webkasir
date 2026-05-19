<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function login()
    {
        // Redirect user yang sudah login ke halaman sesuai rolenya
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return redirect('/admin/produk');
            } else {
                return redirect('/user/produk');
            }
        }
        return view('auth.login');
    }

    // Memproses permintaan login dari user
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Autentikasi dan pengecekan role user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role_id == 1) { 
                return redirect()->intended('/admin/produk');
            } else { 
                return redirect()->intended('/user/produk');
            }
        }

        // Kembalikan ke halaman login jika autentikasi gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Mengakhiri sesi login (logout)
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}