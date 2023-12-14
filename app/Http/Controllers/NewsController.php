<?php

namespace App\Http\Controllers;

use Adminlte3\Auth\Auth;
use Adminlte3\Models\News;
use Adminlte3\Models\NewsCategory;
use Adminlte3\Models\Page;
use Adminlte3\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    public array $bread = [];
    protected $news_page;

    public function __construct() {
        $this->news_page = Page::whereAlias('news')
            ->get()
            ->first();
        $this->bread[] = [
            'url'  => route('news'),
            'name' => $this->news_page['name']
        ];
    }

    public function index() {
        $page = $this->news_page;
        if (!$page) return abort(404);
        $bread = $page->getBread();
        $page->h1 = $page->getH1();
        $page->ogGenerate();
        $page->setSeo();

        if (count(request()->query())) {
            View::share('canonical', route('news'));
        }

        $news_categories = NewsCategory::all();

        $cat = \request()->get('cat', null);
        if ($cat === null) {
            $news = News::public()
                ->orderBy('date', 'desc')
                ->paginate(9);
        } elseif($cat == 0) {
            $news = News::public()
                ->where('news_category', '=', null)
                ->orderBy('date', 'desc')
                ->paginate(9);
        } else {
            $news = News::public()
                ->where('news_category', $cat)
                ->orderBy('date', 'desc')
                ->paginate(9);
        }

        return view('news.index', [
            'h1' => $page->h1,
            'bread' => $bread,
            'news' => $news,
            'news_categories' => $news_categories,
            'cat' => $cat
        ]);
    }

    public function item($alias) {
        $item = News::whereAlias($alias)->public()->first();
        if (!$item) abort(404);

        $bread = $this->bread;
        $bread[] = [
            'url' => $item->url,
            'name' => $item->name
        ];
        $item->setSeo();
        $item->ogGenerate();

        Auth::init();
        if (Auth::user() && Auth::user()->isAdmin) {
            View::share('admin_edit_link', route('admin.news.edit', [$item->id]));
        }

        $prev_item = News::public()
            ->orderBy('date', 'desc')
            ->where('date', '<', $item->date)
            ->first();

        $next_item = News::public()
            ->orderBy('date', 'desc')
            ->where('date', '>', $item->date)
            ->first();

        //recent news
        if (!in_array($item->id, session('recent_news', []))) {
            session()->push('recent_news', $item->id);
        }
        $recent_news_ids = session('recent_news', []);
        $recent_news = News::whereIn('id', $recent_news_ids)->limit(5)->get();

        $news_categories = NewsCategory::all();

//        $news_related = News::where('id', '!=', $item->id)
//            ->orderBy('date', 'desc')
//            ->public()
//            ->limit(Settings::get('news_related_count', 6))
//            ->get();

//        $city = SiteHelper::getCurrentCity();
//        $search = ['{city}', '{city_name}'];
//        if ($city) {
//            $replace = [' в ' . $city->in_city, $city->name];
//            $item->text = SiteHelper::replaceLinkToRegion($item->text, $city);
//        } else {
//            $replace = [' в Екатеринбурге', 'Екатеринбург'];
//        }
//        $item->text = str_replace($search, $replace, $item->text);

        return view('news.item', [
            'item'      => $item,
            'h1'           => $item->getH1(),
            'text'         => $item->text,
            'bread'        => $bread,
            'next_item'    => $next_item,
            'prev_item'    => $prev_item,
            'recent_news'  => $recent_news,
            'news_categories' => $news_categories
        ]);
    }


}
