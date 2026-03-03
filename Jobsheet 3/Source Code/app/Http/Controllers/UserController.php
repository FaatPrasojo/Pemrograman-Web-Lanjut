<?php

namespace App\Http\Controllers;

use App\Models\UserModel; // Pastikan penulisan Model benar (UserModel, bukan UserMOdel)
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // 1. Pastikan record dengan username 'customer-1' ada sebelum diupdate
        $userExist = UserModel::where('username', 'customer-1')->first();

        if ($userExist) {
            $userExist->update([
                'nama' => 'Pelanggan Pertama',
                // Pastikan level_id di bawah ini ada di tabel m_level
                // 'level_id' => 1 
            ]);
        }

        $user = UserModel::all();
        return view('user', ['data' => $user]);
    }
}