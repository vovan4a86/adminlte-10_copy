<?php

namespace Database\Factories;

use Adminlte3\Models\Product;
use Adminlte3\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $name = ucfirst(fake()->words(rand(1, 7), true));

        return [
            'catalog_id' => fake()->numberBetween(3,12),
            'name' => $name,
            'h1' => $name,
            'alias' => Text::translit($name),
            'title' => $name,
            'price' => fake()->numberBetween(1000, 10000),
            'announce' => fake()->realText(rand(40, 90)),
            'text' => fake()->realText(rand(300, 1000)),
            'order' => fake()->numberBetween(1, 100),
            'published' => 1,
            'in_stock' => 1
        ];
    }
}
