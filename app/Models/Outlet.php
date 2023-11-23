<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table = "outlet";
    protected $fillable = [
        'id_bts',
        'id_depo',
        'id_jenis',
        'nama',              
    ];

    public function bts()
    {
        return $this->belongsTo(Bts::class);
    }
}
