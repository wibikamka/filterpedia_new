<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'sku' => strtoupper(Str::random(8)),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->numberBetween(10000, 500000),
            'stock' => $this->faker->numberBetween(0, 200),
            'category' => $this->faker->randomElement([
                'Elektronik',
                'Fashion',
                'Makanan',
                'Minuman',
                'Alat Rumah Tangga'
            ]),
            'is_active' => $this->faker->boolean(90)
        ];
    }
}
