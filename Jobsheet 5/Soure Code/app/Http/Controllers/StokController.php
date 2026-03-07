<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    // Menampilkan halaman awal stok
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok Barang',
            'list'  => ['Home', 'Stok'],
        ];

        $page = (object) [
            'title' => 'Daftar stok barang dalam sistem',
        ];

        $barang     = BarangModel::select('barang_id', 'barang_nama')->get(); // untuk filter
        $activeMenu = 'stok';

        return view('stok.index', compact('breadcrumb', 'page', 'barang', 'activeMenu'));
    }

    // Ambil data stok dalam bentuk JSON untuk datatables
    public function list(Request $request)
    {
        $stok = StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with(['barang', 'user']);

        // Filter berdasarkan barang
        if ($request->barang_id) {
            $stok->where('barang_id', $request->barang_id);
        }

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('aksi', function ($item) {
                $btn  = '<a href="' . url('/stok/' . $item->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/stok/' . $item->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $item->stok_id) . '">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" '
                    . 'onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan form tambah stok
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list'  => ['Home', 'Stok', 'Tambah'],
        ];

        $page       = (object) ['title' => 'Tambah stok barang'];
        $barang     = BarangModel::select('barang_id', 'barang_nama')->get();
        $user       = UserModel::select('user_id', 'nama')->get();
        $activeMenu = 'stok';

        return view('stok.create', compact('breadcrumb', 'page', 'barang', 'user', 'activeMenu'));
    }

    // Menyimpan data stok baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id'    => 'required|integer',
            'user_id'      => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah'  => 'required|integer|min:1',
        ]);

        StokModel::create([
            'barang_id'    => $request->barang_id,
            'user_id'      => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah'  => $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan.');
    }

    // Menampilkan detail stok
    public function show(string $id)
    {
        $stok = StokModel::with(['barang', 'user'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list'  => ['Home', 'Stok', 'Detail'],
        ];

        $page       = (object) ['title' => 'Detail stok barang'];
        $activeMenu = 'stok';

        return view('stok.show', compact('breadcrumb', 'page', 'stok', 'activeMenu'));
    }

    // Menampilkan form edit stok
    public function edit(string $id)
    {
        $stok   = StokModel::find($id);
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user   = UserModel::select('user_id', 'nama')->get();

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list'  => ['Home', 'Stok', 'Edit'],
        ];

        $page       = (object) ['title' => 'Edit stok barang'];
        $activeMenu = 'stok';

        return view('stok.edit', compact('breadcrumb', 'page', 'stok', 'barang', 'user', 'activeMenu'));
    }

    // Menyimpan perubahan data stok
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id'    => 'required|integer',
            'user_id'      => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah'  => 'required|integer|min:1',
        ]);

        StokModel::find($id)->update([
            'barang_id'    => $request->barang_id,
            'user_id'      => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah'  => $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah.');
    }

    // Menghapus data stok
    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan.');
        }

        try {
            StokModel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terkait dengan data lain.');
        }
    }
}