<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q'));

        $products = collect();
        $recommended = collect();

        if ($q && strlen($q) >= 2) {
            $products = $this->baseProductSearch($q)
                ->with('primaryImage')
                ->paginate(12)
                ->withQueryString();
        }else{
            $recommended = Product::where('is_active', 1)
                ->with('primaryImage')
                ->latest()
                ->limit(12)
                ->get();
        }
    

        return view('user.page.search', compact('products', 'recommended', 'q'));
    }

    public function products(Request $request)
    {
        $q = trim($request->get('q'));

        if (!$q || strlen($q) < 2) {
            return response()->json([]);
        }

return $this->baseProductSearch($q)
    ->with('primaryImage')
    ->limit(8)
    ->get()
    ->map(fn($product)=>[
        'name' => $product->name,
        'url' => route('product.show', $product),
        'image' => $product->primaryImage
            ? asset('storage/' . $product->primaryImage->path)
            : asset('img/no-image.png'),
    ]);


    }
    private function baseProductSearch(string $q)
{
    return Product::query()
        ->where('is_active', 1)
        ->where(function ($query) use ($q) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('sku', 'like', "%{$q}%");
        });
}

}
