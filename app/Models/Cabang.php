<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    protected $table = "cabang";
    protected $fillable = [
        'id_warehouse',
        'nama',
        'alamat',             
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
