<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function showLoginForm(){
        return view('auth.admin-login');
    }

    // public function login(Request $request)
    // {
        
        
    //     // 1. Validasi Input
    //     $credentials = $request->validate([
    //         'username' => ['required', 'string'],
    //         'password' => ['required', 'string'],
    //     ]);

        
    //     // 2. Coba autentikasi
    //     // Percobaan otentikasi menggunakan field 'username' dan 'password'
    //     // dd($request->all());
    //     if (Auth::attempt($credentials)) {
    //         // Regenerasi session untuk mencegah session fixation
    //         $request->session()->regenerate();
            

    //         // Redirect ke halaman yang dituju setelah login
    //         // dd($request->all());
    //         return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
    //     }

    //     // 3. Jika gagal, kembali dengan error
    //     return back()->withErrors([
    //         'username' => 'Username atau password atau Auth tidak titemukan.',
    //     ])->onlyInput('username');
    // }

    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Coba autentikasi menggunakan GUARD KHUSUS 'admin'
        // Jika autentikasi berhasil, sesi Admin akan dibuat secara terpisah.
        if (Auth::guard('admin')->attempt($credentials)) {
            // Regenerasi session untuk mencegah session fixation
            $request->session()->regenerate();
            
            // Redirect ke halaman yang dituju setelah login
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        // 3. Jika gagal, kembali dengan error
        return back()->withErrors([
            // Ubah pesan error agar lebih spesifik
            'username' => 'Username atau password Admin tidak cocok.', 
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidasi session saat ini
        $request->session()->invalidate();

        // Regenerasi token CSRF baru
        $request->session()->regenerateToken();

        // Redirect ke halaman home/login
        return redirect('/')->with('success', 'Anda telah logout.');
    }




    
}
