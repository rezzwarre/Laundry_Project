<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi (mass assignable).
     */
    protected $fillable = [
        'username',
        'password',
        'nama',
        'alamat',
        'no_hp',
    ];

    /**
     * Kolom yang disembunyikan saat data di-serialize (misalnya ke JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi otomatis tipe data tertentu.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // otomatis hash saat diset
        ];
    }

    /**
     * Mengubah kolom autentikasi dari 'email' menjadi 'username'.
     * (Opsional — hanya jika kamu pakai sistem login bawaan Laravel)
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_user');
    }
    
}
