<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryDescriptionSeeder extends Seeder
{
    public function run(): void
    {
        $descriptions = [
            'cartridge-filter' => 'Berbagai jenis cartridge filter untuk aplikasi penyaringan air, dirancang untuk menangkap partikel tersuspensi seperti sedimen, pasir, dan kontaminan mikro. Digunakan pada sistem filtrasi rumah tangga, komersial, hingga instalasi pengolahan air skala industri.',

            'membrane-ro' => 'Pilihan membrane reverse osmosis untuk proses pemurnian air melalui teknologi membran semi-permeabel. Umum digunakan pada sistem pengolahan air minum, laboratorium, maupun aplikasi industri yang memerlukan tingkat penyaringan sangat tinggi.',

            'uv-lamp' => 'Lampu ultraviolet untuk sistem sterilisasi air yang memanfaatkan radiasi UV dalam proses pengendalian mikroorganisme. Digunakan pada instalasi pengolahan air bersih, air minum, serta berbagai aplikasi sanitasi air lainnya.',

            'spare-parts' => 'Komponen dan suku cadang pendukung untuk sistem filtrasi dan pengolahan air, mencakup berbagai aksesoris instalasi serta komponen pengganti yang diperlukan dalam perawatan maupun pengoperasian sistem.',

            'industrial-chemicals' => 'Produk kimia untuk kebutuhan pengolahan air pada aplikasi industri, termasuk formulasi yang digunakan dalam pengendalian kerak, korosi, dan kondisi operasional pada berbagai sistem pengolahan air proses.',
        ];

        foreach ($descriptions as $slug => $description) {
            Category::where('slug', $slug)->update([
                'description' => $description
            ]);
        }
    }
}