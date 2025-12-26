<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';

    protected $guarded = ['id', 'created_at', 'updated_at'];
    // protected $fillable = [
    //     'id_user',
    //     'id_jasa',
    //     'jumlah_barang',
    //     'total_harga',
    //     'tanggal_terima',
    //     'tanggal_selesai',
    //     'status_pengerjaan'
    // ];

    protected $fillable = [
        'kode_invoice', 'id_user', 'id_jasa', 'jumlah_barang', 
        'total_harga','description', 'status_pembayaran', 'tanggal_terima', 
        'tanggal_selesai', 'status_pengerjaan','antar_jemput', 'biaya_antar_jemput'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jasa()
    {
        return $this->belongsTo(Jenis_jasa::class, 'id_jasa');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'id_transaksi');
    }

    
}
