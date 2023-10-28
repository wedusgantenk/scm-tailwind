<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiCabangDetail extends Model
{
    use HasFactory;
    protected $table = "transaksi_distribusi_cabang_detail";
    protected $fillable = [
        'jumlah',
        'mulai',
        'akhir'        
    ];
}
