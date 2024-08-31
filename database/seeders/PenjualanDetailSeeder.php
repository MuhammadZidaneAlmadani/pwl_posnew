<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // Isi data dengan 3 barang untuk setiap transaksi penjualan
        for ($i = 1; $i <= 10; $i++) {
            $data[] = ['penjualan_id' => $i, 'barang_id' => 1, 'harga' => 2500000, 'jumlah' => 2];
            $data[] = ['penjualan_id' => $i, 'barang_id' => 3, 'harga' => 150000, 'jumlah' => 5];
            $data[] = ['penjualan_id' => $i, 'barang_id' => 5, 'harga' => 75000, 'jumlah' => 10];
        }

        DB::table('t_penjualan_detail')->insert($data);
    }
}