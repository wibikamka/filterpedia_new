<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{   
        protected $imageService; // 🔥 TAMBAHKAN PROPERTY

    // 🔥 TAMBAHKAN CONSTRUCTOR UNTUK DEPENDENCY INJECTION
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    /* =======================
     * CREATE PRODUCT
     * ======================= */
    public function create(
        array $data,
        array $images = [],
        ?int $primaryImageId = null,
        array $specifications = [] // 🔥 TAMBAHKAN PARAMETER INI
    ): Product {
        return DB::transaction(function () use ($data, $images, $primaryImageId, $specifications) {

            $data['slug'] = $this->generateUniqueSlug($data['name']);

            $product = Product::create($data);

            if (!empty($images)) {
                $this->attachImages($product, $images);
            }

            if ($primaryImageId) {
                $this->setPrimaryImage($product, $primaryImageId);
            }

            // 🔥 TAMBAHKAN HANDLE SPECIFICATIONS
            if (!empty($specifications)) {
                $this->handleSpecifications($product, $specifications);
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
        array $deletedImageIds = [],
        array $specifications = [] 
    ): Product {
        return DB::transaction(function () use (
            $product,
            $data,
            $newImages,
            $primaryImageId,
            $deletedImageIds,
            $specifications 
        ) {

            // 🔹 slug update
            if (isset($data['name']) && $data['name'] !== $product->name) {
                $data['slug'] = $this->generateUniqueSlug(
                    $data['name'],
                    $product->id
                );
            }

            $product->update($data);

            // 🔥 DELETE IMAGES
            if (!empty($deletedImageIds)) {
                ProductImage::where('product_id', $product->id)
                    ->whereIn('id', $deletedImageIds)
                    ->get()
                    ->each(function ($image) {
                        $this->imageService->deleteImage($image->path); 
                        $image->delete();
                    });
            }

            if (!empty($newImages)) {
                $this->attachImages($product, $newImages);
            }

            if ($primaryImageId) {
                $this->setPrimaryImage($product, $primaryImageId);
            }

            // 🔥 TAMBAHKAN HANDLE SPECIFICATIONS
            if (!empty($specifications)) {
                $this->handleSpecifications($product, $specifications);
            }

            // Fallback primary image jika tidak ada
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
                $this->imageService->deleteImage($image->path);
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
            $path = $this->imageService->convertToWebP($file, 'products');

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

            $this->imageService->deleteImage($image->path);

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

    /**
     * Handle specifications untuk produk
     */
    private function handleSpecifications(Product $product, array $specifications): void
    {
        // Hapus semua spesifikasi lama
        $product->specifications()->delete();
        
        $sortOrder = 0;
        
        foreach ($specifications as $spec) {
            // Skip jika key atau value kosong
            if (empty($spec['key']) || empty($spec['value'])) {
                continue;
            }
            
            $product->specifications()->create([
                'spec_key' => $spec['key'],
                'spec_value' => $spec['value'],
                'sort_order' => $sortOrder++
            ]);
        }
    }
}