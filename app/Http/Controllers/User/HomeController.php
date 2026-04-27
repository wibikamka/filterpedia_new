<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Post;    
use App\Models\Category;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $categories = Category::where('is_active', 1)->get();

        $latestPosts = Post::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(2)
            ->get();
                $postCategories = Post::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->distinct()
            ->pluck('category')
            ->toArray();

        // Ambil semua kategori unik dari tabel Post

        // Format kategori dengan 3 post terbaru masing-masing
        $blogCategories = collect($postCategories)->map(function($categorySlug) {
            $categoryName = match($categorySlug) {
                'news' => 'News',
                'knowledge' => 'Knowledge',
                'lifestyle' => 'Lifestyle',
                'product-info' => 'Product Info',
                default => ucfirst(str_replace('-', ' ', $categorySlug))
            };
            
            $posts = Post::where('is_published', true)
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->where('category', $categorySlug)
                ->latest('published_at')
                ->take(3)
                ->get()
                ->map(function($post) {
                    // Bersihkan content dari karakter yang bisa merusak JSON
                    $cleanContent = strip_tags($post->content ?? '');
                    $cleanContent = preg_replace('/\s+/', ' ', $cleanContent);
                    $cleanContent = trim($cleanContent);
                    
                    $cleanExcerpt = $post->excerpt ? strip_tags($post->excerpt) : null;
                    if ($cleanExcerpt) {
                        $cleanExcerpt = preg_replace('/\s+/', ' ', $cleanExcerpt);
                        $cleanExcerpt = trim($cleanExcerpt);
                    }
                    
                    $cleanTitle = preg_replace('/\s+/', ' ', trim($post->title));
                    
                            $thumbnailUrl = $post->thumbnail_url 
            ?? asset('storage/blog/blog-home-section.webp') 
            ?? asset('img/placeholder.jpg');

                    return [
                        'id' => $post->id,
                        'slug' => $post->slug,
                        'title' => $cleanTitle,
                        'excerpt' => $cleanExcerpt,
                        'clean_content' => Str::limit($cleanContent, 120),
                        'thumbnail_url' => $thumbnailUrl, // GUNAKAN ACCESSOR DARI MODEL
                        'category' => $post->category,
                        'formatted_date' => $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y'),
                    ];
                });

            return [
                'id' => $categorySlug,
                'name' => $categoryName,
                'slug' => $categorySlug,
                'posts' => $posts,
            ];
        })->filter(function($category) {
            return $category['posts']->count() > 0;
        })->values();

        return view('user.page.home', compact('products', 'categories', 'latestPosts', 'blogCategories'));
    }
}