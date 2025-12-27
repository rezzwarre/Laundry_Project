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
        'kode_invoice',

        //Relasi
        'id_user',
        'id_jasa',

        //Pelanggan (kasir)
        'nama_pelanggan',
        'alamat_pelanggan',
        'no_hp_pelanggan',

        //Transaksi inti
        'jumlah_barang',
        'total_harga',
        'description',

        //Antar Jemput
        'antar_jemput',
        'biaya_antar_jemput',

        //Status
        'status_pembayaran',
        'status_pengerjaan',

        //Tanggal
        'tanggal_terima',
        'tanggal_selesai',

        //Penanda sumber
        'sumber_transaksi'
    ];

    protected $casts = [
        'antar_jemput' => 'boolean',
        'tanggal_terima' => 'date',
        'tanggal_selesai' => 'date',
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
