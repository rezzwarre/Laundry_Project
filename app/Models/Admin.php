<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // penting untuk Auth
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';          // nama tabel di database
    protected $primaryKey = 'id_admin';   // primary key tabel
    public $timestamps = true;            // aktifkan timestamps jika ada kolom created_at, updated_at

    protected $fillable = [
        'username',
        'password',
        'nama',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed', // otomatis hash password saat diset
        ];
    }

    /**
     * Ganti kolom autentikasi default (email) menjadi username.
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
