<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productPrefixes = ['Sweater', 'Shirt', 'Beanie', 'Jeans', 'Parka'];

        return [
            'receipt_id' => Receipt::factory(),
            'name' => Arr::random($productPrefixes),
        ];
    }
}
