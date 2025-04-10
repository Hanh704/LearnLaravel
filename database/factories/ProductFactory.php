<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ma_san_pham' => $this->faker->unique()->numerify('SHOP-####'),
            'ten_san_pham' => $this->faker->word,
            'category_id' => Category::factory(),
            'gia' => $this->faker->randomFloat(2, 1000, 100000), 
            'gia_khuyen_mai' => $this->faker->optional()->randomFloat(2, 500, 90000),
            'so_luong' => $this->faker->numberBetween(1, 100),
            'ngay_nhap' => $this->faker->date,
            'mota' => implode(' ', $this->faker->sentences(3)), 
            'trang_thai' => $this->faker->boolean,
        ];
        
    }
}
