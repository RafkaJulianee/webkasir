<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 1) {
                return redirect('/admin/produk');
            } else {
                return redirect('/user/produk');
            }
        }
        return view('auth.login');
    }

    // Memproses data login
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kecocokan email dan password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role_id user yang login
            if (Auth::user()->role_id == 1) { // 1 = Admin
                return redirect()->intended('/admin/produk'); // Arahkan ke rute admin
            } else { // 2 = User
                return redirect()->intended('/user/produk'); // Arahkan ke rute user
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}