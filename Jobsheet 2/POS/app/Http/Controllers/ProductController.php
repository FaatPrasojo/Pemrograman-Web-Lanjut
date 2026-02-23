<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function foodBeverage() {
        return view('products.index', ['category' => 'Food & Beverage']);
    }

    public function beautyHealth() {
        return view('products.index', ['category' => 'Beauty & Health']);
    }

    public function homeCare() {
        return view('products.index', ['category' => 'Home Care']);
    }

    public function babyKid() {
        return view('products.index', ['category' => 'Baby & Kid']);
    }
}