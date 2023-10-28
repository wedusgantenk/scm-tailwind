<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiCabang extends Model
{
    use HasFactory;
    protected $table = "transaksi_distribusi_cabang";
    protected $fillable = [
        'id_petugas',
        'id_warehouse',
        'id_cabang',
        'tanggal',
        'status'	             
    ];

    public function jenis_barang()
    {
        return $this->belongsTo(TransaksiCabangDetail::class);
    }
}
