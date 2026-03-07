<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $barangIds = DB::table('m_barang')->pluck('barang_id');
        $userId = DB::table('m_user')->first()->user_id ?? 1;
        
        foreach ($barangIds as $id) {
            DB::table('t_stok')->insert([
                'barang_id'    => $id,
                'user_id'      => $userId,
                'stok_tanggal' => now(),
                'stok_jumlah'  => 100,
            ]);
        }
    }
}