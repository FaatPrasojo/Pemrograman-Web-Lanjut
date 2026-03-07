<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriIds = DB::table('m_kategori')->pluck('kategori_id');
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'kategori_id' => $kategoriIds[($i - 1) % 5],
                'barang_kode' => 'BRG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'barang_nama' => 'Barang ' . $i,
                'harga_beli'  => 10000 * $i,
                'harga_jual'  => 12000 * $i, 
            ];
        }
        DB::table('m_barang')->insert($data);
    }
}