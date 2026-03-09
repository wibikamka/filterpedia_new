<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $categories = Category::where('is_active', 1)->get();

        return view('user.page.home', compact('products','categories'));
    }
}
