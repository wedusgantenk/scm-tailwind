<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = "barang_masuk";
    protected $fillable = [
        'id_produk',
        'id_petugas',
        'tanggal',        
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_produk');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }
}
