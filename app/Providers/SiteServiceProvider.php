<?php

namespace App\Providers;

use Adminlte3\Cart;
use Adminlte3\Models\Catalog;
use Adminlte3\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer(['blocks.header'], function (\Illuminate\View\View $view) {
//            session()->forget('favorites');

//            $topMenu = Cache::get('top_menu', collect());
//            if(!count($topMenu)) {
                $topMenu = Page::query()
                    ->public()
                    ->where('parent_id', 1)
                    ->where('on_header', 1)
                    ->orderBy('order')
                    ->get();
//                Cache::add('top_menu', $topMenu, now()->addMinutes(60));
//            }

//            $topCatalog = Cache::get('top_catalog', collect());
//            if(!count($topCatalog)) {
                $topCatalog = Catalog::query()
                    ->where('parent_id', 0)
                    ->public()
                    ->orderBy('order')
                    ->get();
//                Cache::add('top_catalog', $topCatalog, now()->addMinutes(60));
//            }

//            $cities = City::query()->orderBy('name')
//                ->get(['id', 'alias', 'name', DB::raw('LEFT(name,1) as letter')]);
//
//            if($alias = session('city_alias')) {
//                $city = City::whereAlias($alias)->first();
//                $current_city = $city->name;
//            } else {
                $current_city = null;
//            }

            $cart_items = Cart::all();

            $view->with(compact(
                'topMenu',
                'topCatalog',
                'current_city',
                'cart_items'
            ));
        });

        View::composer(['blocks.footer'], function ($view) {
//            $footerMenu = Cache::get('footer_menu', collect());
//            if(!count($footerMenu)) {
                $footerMenuFull = Page::query()
                    ->public()
                    ->where('parent_id', 1)
                    ->where('on_footer', 1)
                    ->orderBy('order')
                    ->get();

                $count = round($footerMenuFull->count() / 2);
                $footerMenu = $footerMenuFull->chunk($count);
//                Cache::add('footer_menu', $footerMenu, now()->addMinutes(60));
//            }

            $view->with(compact('footerMenu'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
