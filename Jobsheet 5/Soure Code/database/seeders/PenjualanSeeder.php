<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
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
            ]);

            // Input 3 barang per transaksi
            for ($j = 0; $j < 3; $j++) {
                $idx = ($i + $j) % 10;
                $barang = DB::table('m_barang')->where('barang_id', $barangIds[$idx])->first();

                DB::table('t_penjualan_detail')->insert([
                    'penjualan_id' => $penjualanId,
                    'barang_id'    => $barang->barang_id,
                    'harga'        => $barang->harga_jual,
                    'jumlah'       => 1,
                ]);
            }
        }
    }
}