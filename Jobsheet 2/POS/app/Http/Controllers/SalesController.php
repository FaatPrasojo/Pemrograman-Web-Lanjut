<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view('sales');
    }

    public function process(Request $request)
    {
        $totalHarga = 52000; // Contoh total statis dari tabel
        $jumlahBayar = $request->input('payment');

        if ($jumlahBayar >= $totalHarga) {
            return redirect()->back()->with('status', 'success')->with('message', 'Pembayaran Berhasil! Kembalian: Rp ' . ($jumlahBayar - $totalHarga));
        } else {
            return redirect()->back()->with('status', 'error')->with('message', 'Pembayaran Gagal! Silakan bayar sesuai total harga.');
        }
    }
}