<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'LAN',
                'barang_nama' => 'Kabel LAN',
                'harga_beli' => 8000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'ROU',
                'barang_nama' => 'Router',
                'harga_beli' => 25000,
                'harga_jual' => 35000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1,
                'barang_kode' => 'KAL',
                'barang_nama' => 'Kalkulator',
                'harga_beli' => 15000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 5,
                'barang_kode' => 'OBE',
                'barang_nama' => 'Obeng',
                'harga_beli' => 9000,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 5,
                'barang_kode' => 'KUL',
                'barang_nama' => 'Kunci L',
                'harga_beli' => 20000,
                'harga_jual' => 35000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 2,
                'barang_kode' => 'BAS',
                'barang_nama' => 'Bola Basket',
                'harga_beli' => 250000,
                'harga_jual' => 275000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 2,
                'barang_kode' => 'SBL',
                'barang_nama' => 'Stik Billiard',
                'harga_beli' => 650000,
                'harga_jual' => 750000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,
                'barang_kode' => 'RKT',
                'barang_nama' => 'Raket',
                'harga_beli' => 120000,
                'harga_jual' => 150000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 4,
                'barang_kode' => 'HVS',
                'barang_nama' => 'Kertas HVS',
                'harga_beli' => 5000,
                'harga_jual' => 7500,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 4,
                'barang_kode' => 'PEN',
                'barang_nama' => 'Pulpen',
                'harga_beli' => 10000,
                'harga_jual' => 12000,
            ],
            [
                'barang_id' => 11,
                'kategori_id' => 3,
                'barang_kode' => 'SAP',
                'barang_nama' => 'Sapu',
                'harga_beli' => 7000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 3,
                'barang_kode' => 'PEL',
                'barang_nama' => 'Kain Pel',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 3,
                'barang_kode' => 'WJN',
                'barang_nama' => 'Wajan',
                'harga_beli' => 12000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 3,
                'barang_kode' => 'VAC',
                'barang_nama' => 'Vacum Cleaner',
                'harga_beli' => 110000,
                'harga_jual' => 150000,
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 3,
                'barang_kode' => 'PCI',
                'barang_nama' => 'Panci',
                'harga_beli' => 15000,
                'harga_jual' => 22000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
