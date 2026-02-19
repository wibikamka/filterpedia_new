<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Cartridge Filter', 'icon' => 'img/category/cartridge.png'],
            ['name' => 'Membrane RO', 'icon' => 'img/category/ro.png'],
            ['name' => 'UV Lamp', 'icon' => 'img/category/uv.png'],

            // BARU
            ['name' => 'Spare Parts', 'icon' => 'img/category/spare.png'],
            ['name' => 'Industrial Chemicals', 'icon' => 'img/category/chemical.png'],
        ];

        foreach ($data as $item) {
            Category::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'name' => $item['name'],
                    'icon' => $item['icon'],
                    'is_active' => true,
                ]
            );
        }
    }
}
