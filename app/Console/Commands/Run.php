<?php

namespace App\Console\Commands;

use Adminlte3\Models\Product;
use Illuminate\Console\Command;

class Run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run';

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
//        $products = Product::all();
//        $this->info('Products: ' . count($products));

        $i = 1;
        while ($i <= 15) {
            $n = rand(1, 10500);
            $p = Product::find($n);

            if($p) {
                $p->update(['is_top' => 1]);
                $this->info($p->name);
            }
            $i++;
        }
    }
}
