<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function showProfile()
    {
         return view('user.profile.update', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Tangani pembaruan data profil pengguna.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi Input
        $validatedData = $request->validate([
            // Nama Wajib diisi, maksimal 255 karakter
            'nama' => ['required', 'string', 'max:255'],
            
            // Username Wajib diisi, unik, dan tidak boleh berisi spasi
            // Rule::unique diabaikan untuk username pengguna saat ini
            'username' => [
                'required', 
                'string', 
                'max:255', 
                'alpha_dash', // Memastikan tidak ada spasi atau karakter khusus selain dash/underscore
                Rule::unique('users')->ignore($user->id),
            ],

            // No HP Wajib diisi, maksimal 15 digit
            'no_hp' => ['required', 'string', 'max:15'], 
            
            // Alamat Wajib diisi
            'alamat' => ['required', 'string'],
            
        ]);

        // 2. Simpan Pembaruan Data
        // Metode 'update' pada model Eloquent akan secara otomatis menyimpan data yang divalidasi.
        $user->update($validatedData);

        // 3. Redirect dengan pesan sukses
        return redirect()->route('user.dashboard')->with('success', 'Profil Anda berhasil diperbarui!');
    }
}
