<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 

class PageController extends Controller 
{ 
    public function index() {
        return 'Selamat Datang';
    }

    public function about() {
        return 'Nama : Faatihurrizki Prasojo <br> NIM : 244107020142';
    }

    public function articles($id = null) {
        return 'Halaman Artikel dengan ID '.$id; 
    }
}