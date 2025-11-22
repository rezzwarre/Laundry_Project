<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Memproses data registrasi dan menyimpan User baru.
     */
    public function register(Request $request)
    {
        
        //SELESAIKAN INII TUGASSS!!!
        // 1. Validasi Input
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ]);

        

        // 2. Membuat User baru
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        



        // 3. Langsung login setelah registrasi (Opsional)
        Auth::login($user);

        // 4. Redirect ke Dashboard User
        return redirect()->route('user.dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses permintaan login.
     */
    public function login(Request $request)
    {
         
        // 1. Validasi Input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Coba autentikasi
        // Percobaan otentikasi menggunakan field 'username' dan 'password'
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk mencegah session fixation
            $request->session()->regenerate();

            // Redirect ke halaman yang dituju setelah login
            return redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
        }

        // 3. Jika gagal, kembali dengan error
        return back()->withErrors([
            'username' => 'Username atau password tidak cocok.',
        ])->onlyInput('username');
    }

    /**
     * Logout pengguna.
     */
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
