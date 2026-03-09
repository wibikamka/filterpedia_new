<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', 1)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('user.blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('is_published', 1)
            ->latest()
            ->limit(4)
            ->get();

        return view('user.blog.show', compact('post', 'relatedPosts'));
    }
}