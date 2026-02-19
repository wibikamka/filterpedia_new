<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'sku',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category_id',
        'tokopedia_link',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');

    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)
            ->where('is_primary', true)
            ->orderBy('sort_order');
    }

    public function galleryImages()
    {
        return $this->hasMany(ProductImage::class)
            ->where('is_primary', false)
            ->orderBy('sort_order');
    }


}
