<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run():void
    {
        $Data =[
            ['level_id' => 1, 'level_kode'=>'ADM','level_nama'=>'administrator'],
            ['level_id' => 2, 'level_kode'=>'MNG','level_nama'=>'manager'],
            ['level_id' => 3, 'level_kode'=>'STF','level_nama'=>'staf/kasir'],
        ];
        DB::table('m_level')->insert($Data);
    }
}    