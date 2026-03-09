<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    /**
     * Konversi gambar ke WebP
     *
     * @param UploadedFile $file
     * @param string $path
     * @param int $quality
     * @return string
     */
    public function convertToWebP(UploadedFile $file, string $path = 'products', int $quality = 80): string
    {
        // Generate nama file unik
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = $this->sanitizeFilename($originalName) . '-' . time() . '-' . uniqid() . '.webp';
        $filePath = $path . '/' . $filename;
        
        // Baca file dan konversi
        $image = Image::read($file);
        
        // Resize jika terlalu besar (opsional)
        if ($image->width() > 1920) {
            $image->scale(width: 1920);
        }
        
        // Encode ke WebP dan simpan
        $encoded = $image->toWebp($quality);
        Storage::disk('public')->put($filePath, (string) $encoded);
        
        return $filePath;
    }
    
    /**
     * Konversi multiple gambar ke WebP
     *
     * @param array $files
     * @param string $path
     * @return array
     */
    public function convertMultipleToWebP(array $files, string $path = 'products'): array
    {
        $uploadedPaths = [];
        
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $uploadedPaths[] = $this->convertToWebP($file, $path);
            }
        }
        
        return $uploadedPaths;
    }
    
    /**
     * Sanitasi filename (hapus karakter khusus)
     *
     * @param string $filename
     * @return string
     */
    private function sanitizeFilename(string $filename): string
    {
        $filename = strtolower($filename);
        $filename = preg_replace('/[^a-z0-9]+/', '-', $filename);
        return trim($filename, '-');
    }
    
    /**
     * Hapus gambar dari storage
     *
     * @param string $path
     * @return bool
     */
    public function deleteImage(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
    
    /**
     * Dapatkan informasi dimensi gambar
     *
     * @param string $path
     * @return array|null
     */
    public function getDimensions(string $path): ?array
    {
        if (!Storage::disk('public')->exists($path)) {
            return null;
        }
        
        $fullPath = Storage::disk('public')->path($path);
        $image = Image::read($fullPath);
        
        return [
            'width' => $image->width(),
            'height' => $image->height(),
        ];
    }
}