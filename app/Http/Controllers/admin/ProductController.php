<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $allowedSorts = ['name', 'price', 'stock', 'updated_at', 'created_at', 'sku'];
        $sortBy  = in_array($request->sort_by, $allowedSorts) ? $request->sort_by : 'updated_at';
        $sortDir = $request->sort_dir === 'asc' ? 'asc' : 'desc';

        $products = Product::with(['images', 'category'])
            ->when($request->search, fn($q) =>
                $q->where('name', 'like', '%' . $request->search . '%')
            )
            ->when($request->category, fn($q) =>
                $q->where('category_id', $request->category)
            )
            ->orderBy($sortBy, $sortDir)
            ->paginate(20)
            ->withQueryString();

        $categories = Category::where('is_active', 1)->orderBy('name')->get();

        return view('admin.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->get();

        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request, ProductService $service)
    {
        $data = $request->validate([
            'sku'              => 'required|string|max:255|unique:products,sku',
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'category_id'      => 'required|exists:categories,id',
            'tokopedia_link'   => 'nullable|url|max:255',
            'is_active'        => 'required|boolean',
            'images.*'         => 'nullable|image|max:2048',
            'primary_image_id' => 'nullable|exists:product_images,id',
        ]);

        $service->create(
            $data,
            $request->file('images', []),
            $request->input('primary_image_id')
        );

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::where('is_active', 1)->get();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product, ProductService $service)
    {
        $data = $request->validate([
            'sku'              => 'required|string|max:255|unique:products,sku,' . $product->id,
            'name'             => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'category_id'      => 'required|exists:categories,id',
            'tokopedia_link'   => 'nullable|url|max:255',
            'is_active'        => 'required|boolean',
            'images.*'         => 'nullable|image|max:2048',
            'primary_image_id' => 'nullable|exists:product_images,id',
            'deleted_images.*' => 'nullable|exists:product_images,id',
        ]);

        $service->update(
            $product,
            $data,
            $request->file('images', []),
            $request->input('primary_image_id'),
            $request->input('deleted_images', [])
        );

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product, ProductService $service)
    {
        $service->delete($product);

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}