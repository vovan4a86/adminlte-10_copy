<?php

namespace App\Http\Controllers;

use Adminlte3\Models\Catalog;
use Adminlte3\Models\News;
use Adminlte3\Models\Page;
use Adminlte3\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
//        Auth::logout();

        $page = Page::find(1);
//        $page = $this->add_region_seo($page);
        $page->ogGenerate();
        $page->setSeo();

        $news = News::public()->where('on_main', 1)->get();
        $top_products_collect = Product::public()->where('is_top', 1)
            ->inRandomOrder()
            ->limit(15)
            ->with(['images', 'catalog'])
            ->get();
        $top_products = $top_products_collect->chunk(3);

        $new_products = Product::public()->where('is_new', 1)
            ->inRandomOrder()
            ->limit(10)
            ->with(['images', 'catalog'])
            ->get();

        $featured_products = Product::public()->where('is_featured', 1)
            ->inRandomOrder()
            ->limit(10)
            ->with(['images', 'catalog'])
            ->get();

        $top_rated_products = Product::public()->where('is_featured', 1)
            ->inRandomOrder()
            ->limit(10)
            ->with(['images', 'catalog'])
            ->get();

        $best_sellers_collect = Product::public()
            ->where('price', '>', 1000)
            ->limit(14)
            ->with(['images', 'catalog'])
            ->get();

        $best_sellers = $best_sellers_collect->chunk(2);

        return view('pages.index', compact(
            'news',
            'top_products',
            'new_products',
            'featured_products',
            'top_rated_products',
            'best_sellers'
        ));
    }
}
