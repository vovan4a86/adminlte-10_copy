<?php

namespace Database\Factories;

use Adminlte3\Models\Catalog;
use Adminlte3\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CatalogFactory extends Factory
{
    protected $model = Catalog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = ucfirst(fake()->words(rand(1, 3), true));
        $url = fake()->image(public_path(Catalog::UPLOAD_URL), 240, 240, $name);
        $arr = explode('/', $url);
        $image = array_pop($arr);
        return [
            'parent_id' => fake()->numberBetween(1,2),
            'name' => $name,
            'h1' => $name,
            'alias' => Text::translit($name),
            'title' => $name,
            'image' => $image,
            'text' => fake()->realText(rand(300, 1000), 5),
            'order' => fake()->numberBetween(1, 20),
            'published' => 1
        ];
    }
}
