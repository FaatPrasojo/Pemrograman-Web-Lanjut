<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('m_user')->first()->user_id ?? 1;
        
        $barangIds = DB::table('m_barang')->pluck('barang_id');

        for ($i = 1; $i <= 10; $i++) {
            $penjualanId = DB::table('t_penjualan')->insertGetId([
                'user_id'           => $userId,
                'pembeli'           => 'Pelanggan ' . $i,
                'penjualan_kode'    => 'TRX' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'penjualan_tanggal' => now(),
                'created_at'        => now(),
            ]);

            for ($j = 0; $j < 3; $j++) {
                $indexBarang = ($i + $j) % count($barangIds);
                $idBarang = $barangIds[$indexBarang];
                
                $hargaJual = DB::table('m_barang')->where('barang_id', $idBarang)->value('harga_jual');

                DB::table('t_penjualan_detail')->insert([
                    'penjualan_id' => $penjualanId,
                    'barang_id'    => $idBarang,
                    'harga'        => $hargaJual,
                    'jumlah'       => rand(1, 5),
                    'created_at'   => now(),
                ]);
            }
        }
    }
}