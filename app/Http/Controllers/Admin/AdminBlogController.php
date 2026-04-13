<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class AdminBlogController extends Controller
{
    
protected $imageService;

public function __construct(ImageService $imageService)
{
    $this->imageService = $imageService;
}

    /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create()
    {
        // Daftar category yang sudah ditentukan
        $categories = [
            'news' => 'News',
            'knowledge' => 'Knowledge',
            'lifestyle' => 'Lifestyle',
            'product-info' => 'Product Info'
        ];
        
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created blog post in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:posts',
            'excerpt' => 'nullable|max:500',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:5048',
            'category' => 'required|in:news,knowledge,lifestyle,product-info',
            'tags' => 'nullable|string',
            'is_published' => 'sometimes|boolean',
            'published_at' => 'nullable|date'
        ]);

        // Handle tags (convert string to array)
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tags = array_filter($tags);
            $validated['tags'] = array_values($tags); // re-index array
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('blog/thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        // Set is_published default false if not provided
        $validated['is_published'] = $request->boolean('is_published', false);

        // Set published_at if post is published
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Create post
        Post::create($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(Post $blog)  // Route model binding - parameter name harus sama dengan route: {blog}
    {
        $categories = [
            'news' => 'News',
            'knowledge' => 'Knowledge',
            'lifestyle' => 'Lifestyle',
            'product-info' => 'Product Info'
        ];
        
        // Convert tags array to string for form input
        $tagsString = $blog->tags ? implode(', ', $blog->tags) : '';
        
        return view('admin.blog.edit', compact('blog', 'categories', 'tagsString'));
    }

    /**
     * Update the specified blog post in storage.
     */
    public function update(Request $request, Post $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:posts,slug,' . $blog->id,
            'excerpt' => 'nullable|max:500',
            'content' => 'required',
            'thumbnail' => 'nullable|image|max:5048',
            'category' => 'required|in:news,knowledge,lifestyle,product-info',
            'tags' => 'nullable|string',
            'is_published' => 'sometimes|boolean',
            'published_at' => 'nullable|date'
        ]);

        // Handle tags (convert string to array)
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tags = array_filter($tags);
            $validated['tags'] = array_values($tags);
        } else {
            $validated['tags'] = null;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($blog->thumbnail) {
                Storage::disk('public')->delete($blog->thumbnail);
            }
            
            $path = $request->file('thumbnail')->store('blog/thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        // Set is_published
        $validated['is_published'] = $request->boolean('is_published', false);

        // Set published_at if post is published
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Update post
        $blog->update($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified blog post from storage.
     */
    public function destroy(Post $blog)
    {
        // Delete thumbnail
        if ($blog->thumbnail) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Upload image from TinyMCE
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $path = $this->imageService->convertToWebP($request->file('image'), 'blog/content', 80);

        return response()->json([
            'location' => asset('storage/' . $path)
        ]);
    }
}