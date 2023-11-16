<?php

namespace App\Console\Commands;

use Adminlte3\Models\News;
use Illuminate\Console\Command;

class RedisTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        News::factory()->count(100)->create();
        $news = \Cache::rememberForever('news:all', function () {
            return News::all();
        });

        dd($news->pluck('name'));
    }
}
