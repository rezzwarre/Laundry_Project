<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_jasa extends Model
{
    use HasFactory;
    protected $table = 'jenis_jasas';

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = ['jenis_jasa', 'jenis_barang', 'harga'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_jasa');
    }



}
