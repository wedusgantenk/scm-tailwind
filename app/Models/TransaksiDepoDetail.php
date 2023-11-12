<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDepoDetail extends Model
{
    use HasFactory;
    protected $table = "transaksi_distribusi_depo_detail";    
    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'kode_unik'        
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class,'id_barang');
    }

    public function transaksi()
    {
        return $this->belongsTo(TransaksiSales::class,'id_transaksi', 'id');
    }
}
