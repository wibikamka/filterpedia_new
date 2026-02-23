<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;


class ProductController extends Controller
{
    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        $product->load([
            'category',
            'primaryImage',
            'galleryImages',
        ]);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', 1)
            ->with('primaryImage')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return view('user.product.detail', compact('product', 'relatedProducts'));
    }
}
