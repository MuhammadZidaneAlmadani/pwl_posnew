<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'barang_kode' => 'BRG01', 'barang_nama' => 'TV', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['kategori_id' => 1, 'barang_kode' => 'BRG02', 'barang_nama' => 'Kulkas', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG03', 'barang_nama' => 'Kemeja', 'harga_beli' => 100000, 'harga_jual' => 150000],
            ['kategori_id' => 2, 'barang_kode' => 'BRG04', 'barang_nama' => 'Celana', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG05', 'barang_nama' => 'Biskuit', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['kategori_id' => 3, 'barang_kode' => 'BRG06', 'barang_nama' => 'Roti', 'harga_beli' => 25000, 'harga_jual' => 40000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG07', 'barang_nama' => 'Susu', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['kategori_id' => 4, 'barang_kode' => 'BRG08', 'barang_nama' => 'Air Mineral', 'harga_beli' => 5000, 'harga_jual' => 8000],
            ['kategori_id' => 5, 'barang_kode' => 'BRG09', 'barang_nama' => 'Kursi', 'harga_beli' => 200000, 'harga_jual' => 300000],
            ['kategori_id' => 5, 'barang_kode' => 'BRG10', 'barang_nama' => 'Meja', 'harga_beli' => 500000, 'harga_jual' => 700000],
        ];

        DB::table('m_barang')->insert($data);
    }
}