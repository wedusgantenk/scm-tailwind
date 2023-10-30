<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Petugas::create([
            'username' => Str::random(10),        
            'password' =>  bcrypt('12345678'),
            'hak_akses' => 'admin',
            'jenis' => '0',
            'bagian' => '0',
        ]);
        //
    }
}
