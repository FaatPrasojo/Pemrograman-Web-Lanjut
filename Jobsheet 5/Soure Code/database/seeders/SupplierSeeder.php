<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['supplier_kode' => 'SUP001', 'supplier_nama' => 'PT Maju Bersama',   'supplier_alamat' => 'Jl. Raya No. 1, Jakarta'],
            ['supplier_kode' => 'SUP002', 'supplier_nama' => 'CV Sumber Makmur',  'supplier_alamat' => 'Jl. Pahlawan No. 5, Surabaya'],
            ['supplier_kode' => 'SUP003', 'supplier_nama' => 'UD Jaya Abadi',     'supplier_alamat' => 'Jl. Merdeka No. 10, Malang'],
            ['supplier_kode' => 'SUP004', 'supplier_nama' => 'PT Sejahtera Raya', 'supplier_alamat' => 'Jl. Diponegoro No. 3, Bandung'],
            ['supplier_kode' => 'SUP005', 'supplier_nama' => 'CV Berkah Utama',   'supplier_alamat' => 'Jl. Sudirman No. 7, Semarang'],
        ];

        DB::table('m_supplier')->insert($data);
    }
}