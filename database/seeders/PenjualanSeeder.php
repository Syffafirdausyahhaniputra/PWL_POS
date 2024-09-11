<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Bambang',
                'penjualan_kode' => '001',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 1,
                'pembeli' => 'Samsul',
                'penjualan_kode' => '002',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 1,
                'pembeli' => 'Sulis',
                'penjualan_kode' => '003',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 2,
                'pembeli' => 'Bagus',
                'penjualan_kode' => '004',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Rohit',
                'penjualan_kode' => '005',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 2,
                'pembeli' => 'Udin',
                'penjualan_kode' => '006',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Mardi',
                'penjualan_kode' => '007',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Yanto',
                'penjualan_kode' => '008',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Bayu',
                'penjualan_kode' => '009',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Suji',
                'penjualan_kode' => '010',
                'penjualan_tanggal' => Carbon::now(),
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
