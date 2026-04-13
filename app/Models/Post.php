<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'is_published',
        'published_at',
        'category',     
        'tags',          
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'tags' => 'array',          
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (!$post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });
        
        // Tambahan: update slug juga kalau title berubah
        static::updating(function ($post) {
            if ($post->isDirty('title') && !$post->isDirty('slug')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
    
    // Accessor untuk menampilkan tags sebagai string (opsional)
    public function getTagsStringAttribute()
    {
        return is_array($this->tags) ? implode(', ', $this->tags) : '';
    }
    
    // Scope untuk filter berdasarkan category
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
    
    // Scope untuk filter berdasarkan tag (json contains)
    public function scopeHasTag($query, $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }
    
    // Scope untuk published posts
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function getThumbnailUrlAttribute()
{
    if ($this->thumbnail) {
        return asset('storage/' . $this->thumbnail);
    }

}
}