<?php

namespace Database\Factories;

use Adminlte3\Models\News;
use Adminlte3\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;


class NewsFactory extends Factory
{
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->realText(rand(10, 30));
        return [
            'name' => $name,
            'alias' => Text::translit($name),
            'date' => fake()->date(),
            'announce' => fake()->realText(rand(50, 80)),
            'text' => fake()->realText(rand(300, 1000)),
            'published' => 1,
            'order' => News::max('order') + 1
        ];
    }
}
