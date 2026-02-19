<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        abort_unless($category->is_active, 404);

        $products = $category->products()
            ->where('is_active', 1)
            ->with('primaryImage')
            ->paginate(12);

        return view('user.product.category', compact('category', 'products'));
    }
}
