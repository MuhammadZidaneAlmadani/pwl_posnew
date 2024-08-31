<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['user_id' => 1, 'pembeli' => 'John Doe', 'penjualan_kode' => 'TRX01', 'penjualan_tanggal' => now()],
            ['user_id' => 1, 'pembeli' => 'Jane Smith', 'penjualan_kode' => 'TRX02', 'penjualan_tanggal' => now()],
            ['user_id' => 2, 'pembeli' => 'Michael Johnson', 'penjualan_kode' => 'TRX03', 'penjualan_tanggal' => now()],
            ['user_id' => 2, 'pembeli' => 'Chris Evans', 'penjualan_kode' => 'TRX04', 'penjualan_tanggal' => now()],
            ['user_id' => 3, 'pembeli' => 'Scarlett Johansson', 'penjualan_kode' => 'TRX05', 'penjualan_tanggal' => now()],
            ['user_id' => 3, 'pembeli' => 'Robert Downey', 'penjualan_kode' => 'TRX06', 'penjualan_tanggal' => now()],
            ['user_id' => 1, 'pembeli' => 'Mark Ruffalo', 'penjualan_kode' => 'TRX07', 'penjualan_tanggal' => now()],
            ['user_id' => 2, 'pembeli' => 'Chris Hemsworth', 'penjualan_kode' => 'TRX08', 'penjualan_tanggal' => now()],
            ['user_id' => 3, 'pembeli' => 'Tom Hiddleston', 'penjualan_kode' => 'TRX09', 'penjualan_tanggal' => now()],
            ['user_id' => 1, 'pembeli' => 'Tom Holland', 'penjualan_kode' => 'TRX10', 'penjualan_tanggal' => now()],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}