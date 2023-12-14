<?php

namespace App\Http\Controllers;

use Adminlte3\Models\Product;
use Adminlte3\Models\ProductChar;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page() {
        return dd('PageController@page');
    }

    public function getCompareList() {
        SEOMeta::setTitle('Список сравнения');
        SEOMeta::setDescription('Список сравнения');

        $compare_ids = session('compare', []);
        $items = Product::whereIn('id', $compare_ids)->with(['images', 'catalog', 'chars'])->get();

        $compare_names = ProductChar::whereIn('product_id', $compare_ids)
            ->groupBy('name')
            ->get('name');

        return view('compare.index', compact('items', 'compare_names'));
    }

    public function getFavoritesList() {

        SEOMeta::setTitle('Список желаний');
        SEOMeta::setDescription('Список желаний');


        $favorites_ids = session('favorites', []);
        $items = Product::whereIn('id', $favorites_ids)->with(['images', 'catalog', 'chars'])->get();

        return view('favorites.index', compact('items'));
    }
}
