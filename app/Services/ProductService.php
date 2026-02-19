<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    /* =======================
     * CREATE PRODUCT
     * ======================= */
    public function create(
        array $data,
        array $images = [],
        ?int $primaryImageId = null
    ): Product {
        return DB::transaction(function () use ($data, $images, $primaryImageId) {

            $data['slug'] = $this->generateUniqueSlug($data['name']);

            $product = Product::create($data);

            if (!empty($images)) {
                $this->attachImages($product, $images);
            }

            if ($primaryImageId) {
                $this->setPrimaryImage($product, $primaryImageId);
            }

            return $product;
        });
    }

    /* =======================
     * UPDATE PRODUCT
     * ======================= */
public function update(
    Product $product,
    array $data,
    array $newImages = [],
    ?int $primaryImageId = null,
    array $deletedImageIds = []
): Product {
    return DB::transaction(function () use (
        $product,
        $data,
        $newImages,
        $primaryImageId,
        $deletedImageIds
    ) {

        // 🔹 slug update
        if (isset($data['name']) && $data['name'] !== $product->name) {
            $data['slug'] = $this->generateUniqueSlug(
                $data['name'],
                $product->id
            );
        }

        $product->update($data);

        // 🔥 DELETE IMAGES (INI YANG HILANG)
        if (!empty($deletedImageIds)) {
            ProductImage::where('product_id', $product->id)
                ->whereIn('id', $deletedImageIds)
                ->get()
                ->each(function ($image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                });
        }

        if (!empty($newImages)) {
            $this->attachImages($product, $newImages);
        }

     
        if ($primaryImageId) {
            $this->setPrimaryImage($product, $primaryImageId);
        }

       
        if (
            !$product->images()
                ->where('is_primary', true)
                ->exists()
        ) {
            $product->images()
                ->orderBy('id')
                ->limit(1)
                ->update(['is_primary' => true]);
        }

        return $product;
    });
}


    /* =======================
     * DELETE PRODUCT
     * ======================= */
    public function delete(Product $product): void
    {
        DB::transaction(function () use ($product) {

            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->path);
            }

            $product->images()->delete();
            $product->delete();
        });
    }

    /* =======================
     * ADD IMAGES
     * ======================= */
    public function attachImages(Product $product, array $images): void 
    {
        foreach ($images as $file) {
            $path = $file->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
                'is_primary' => false,
            ]);
        }

        // fallback primary image
        if (
            !$product->images()
                ->where('is_primary', true)
                ->exists()
        ) {
            $product->images()
                ->orderBy('id')
                ->limit(1)
                ->update(['is_primary' => true]);
        }
    }

    /* =======================
     * DELETE SINGLE IMAGE
     * ======================= */
    public function deleteImage(ProductImage $image): void
    {
        DB::transaction(function () use ($image) {

            Storage::disk('public')->delete($image->path);

            $productId = $image->product_id;
            $wasPrimary = $image->is_primary;

            $image->delete();

            if ($wasPrimary) {
                ProductImage::where('product_id', $productId)
                    ->orderBy('id')
                    ->limit(1)
                    ->update(['is_primary' => true]);
            }
        });
    }

    /* =======================
     * SET PRIMARY IMAGE
     * ======================= */
    public function setPrimaryImage(Product $product, int $imageId): void
    {
        ProductImage::where('product_id', $product->id)
            ->update(['is_primary' => false]);

        ProductImage::where('id', $imageId)
            ->where('product_id', $product->id)
            ->update(['is_primary' => true]);
    }

    /* =======================
     * GENERATE UNIQUE SLUG
     * ======================= */
    protected function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;

        while (
            Product::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($q) => $q->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
