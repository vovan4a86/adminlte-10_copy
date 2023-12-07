<?php

namespace App\Http\Controllers;

use Adminlte3\Models\Catalog;
use Adminlte3\Models\News;
use Adminlte3\Models\Page;
use Adminlte3\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $page = Page::find(1);
//        $page = $this->add_region_seo($page);
        $page->ogGenerate();
        $page->setSeo();

        $news = News::public()->where('on_main', 1)->get();
        $top_products_collect = Product::public()->where('is_top', 1)->limit(15)->get();
        $top_products = $top_products_collect->chunk(5);

        return view('pages.index', compact(
            'news',
            'top_products'
        ));
    }
}
