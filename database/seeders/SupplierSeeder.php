<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'PSM',
                'supplier_nama' => 'PT Elektronik & Otomotif Sumber Makmur',
                'supplier_alamat' => 'Jl. Isekai',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'PJA',
                'supplier_nama' => 'PT Olahraga dan Alat Tulis Jaya',
                'supplier_alamat' => 'Jl. Sekai',
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'PRC',
                'supplier_nama' => 'PT Rumah Ceria',
                'supplier_alamat' => 'Jl. Shin',
            ],
        ];
        DB::table('m_supplier')->insert($data);
    }
}
