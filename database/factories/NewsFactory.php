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
        $name = fake()->realText(20);
        return [
            'name' => $name,
            'alias' => Text::translit($name),
            'date' => fake()->date(),
            'announce' => fake()->realText(50),
            'text' => fake()->realText(300),
            'published' => 1,
            'order' => News::max('order') + 1
        ];
    }
}
