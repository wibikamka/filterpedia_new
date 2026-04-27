<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $posts = $query->paginate(9)->withQueryString();

        // Get categories for filter
   $categories = [
    'berita' => 'Berita',
    'pengetahuan' => 'Pengetahuan',
    'gaya_hidup' => 'Gaya Hidup',
    'informasi_produk' => 'Informasi Produk'  // atau 'product-info' dulu?
];

        return view('user.blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $relatedPosts = Post::where('is_published', true)
            ->where('published_at', '<=', now())
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->limit(2)
            ->get();

        $featuredProducts = Product::where('is_active', true)
         ->latest()
         ->limit(4)
        ->get();

        return view('user.blog.show', compact('post', 'relatedPosts', 'featuredProducts'));
    }
}