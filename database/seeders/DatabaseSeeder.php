<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Adminlte3\Models\Catalog;
use Adminlte3\Models\News;
use Adminlte3\Models\Page;
use Adminlte3\Models\Product;
use Adminlte3\Models\Text;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Page::create([
            'parent_id' => 0,
            'name' => 'Главная',
            'h1' => 'Главная',
            'alias' => '/',
            'text' => fake()->realTextBetween(350, 1200, 4),
            'order' => 0,
            'published' => true,
            'system' => true,
        ]);

        Page::create([
            'parent_id' => 1,
            'name' => 'Каталог',
            'h1' => 'Каталог',
            'alias' => 'catalog',
            'text' => fake()->realTextBetween(350, 1200, 4),
            'order' => 1,
            'published' => true,
            'system' => true,
        ]);

        Page::create([
            'parent_id' => 1,
            'name' => 'Новости',
            'h1' => 'Новости',
            'alias' => 'news',
            'text' => fake()->realTextBetween(350, 1200, 4),
            'order' => 2,
            'published' => true,
            'system' => true,
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.ru',
            'email_verified_at' => now(),
            'password' => '$2y$10$LXFfW7AAAxMvmtbTjY9sIet1NE5JrHj5mWBiSixGQz8Wbw1Qnx4SK', // 12345678
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        News::factory(150)->create();

        Catalog::factory()->create([
            'parent_id' => 0,
            'name' => 'Водоснабжение',
            'h1' => 'Водоснабжение',
            'alias' => Text::translit('Водоснабжение'),
            'title' => 'Водоснабжение',
        ]);

        Catalog::factory()->create([
            'parent_id' => 0,
            'name' => 'Газоснабжение',
            'h1' => 'Газоснабжение',
            'alias' => Text::translit('Газоснабжение'),
            'title' => 'Газоснабжение',
        ]);

        Catalog::factory(10)->create();

        Product::factory(100)->create();
    }
}
