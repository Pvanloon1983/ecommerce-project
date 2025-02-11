<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController
{
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('pages.dashboard', [
            'products' => $products
        ]);
    }
}
