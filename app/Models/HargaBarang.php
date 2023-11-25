<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaBarang extends Model
{
    use HasFactory;
    protected $table = "harga_barang";
    protected $fillable = [
        'id_barang',
        'tanggal',
        'id_jenis_outlet',
        'harga'             
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
    
    public function jenisOutlet()
    {
        return $this->belongsTo(JenisOutlet::class, 'id_jenis_outlet', 'id');
    }
}
