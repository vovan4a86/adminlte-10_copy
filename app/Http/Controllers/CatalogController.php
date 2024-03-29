<?php

namespace App\Http\Controllers;

use Adminlte3\Models\Catalog;
use Adminlte3\Models\Page;
use Adminlte3\Models\Product;
use Adminlte3\Settings;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index() {
        $page = Page::getByPath(['catalog']);
        if (!$page) return abort(404);
        $bread = $page->getBread();
        $page->h1 = $page->getH1();
        $page->setSeo();

        $categories = Catalog::public()
            ->where('parent_id', 0)
            ->orderBy('order')
            ->get();

        return view('catalog.index', [
            'h1' => $page->h1,
            'text' => $page->text,
            'title' => $page->title,
            'bread' => $bread,
            'categories' => $categories,
        ]);
    }

    public function view($alias) {
        $path = explode('/', $alias);
        /* проверка на продукт в категории */
        $product = null;
        $end = array_pop($path);
        $category = Catalog::getByPath($path);
        if ($category && $category->published) {
            $product = Product::whereAlias($end)
                ->public()
                ->whereCatalogId($category->id)->first();
        }
        if ($product) {
            return $this->product($product);
        } else {
            array_push($path, $end);

            return $this->category($path + [$end]);
        }
    }

    public function category($path) {
        /** @var Catalog $category */
        $category = Catalog::getByPath($path);
        if (!$category || !$category->published) abort(404, 'Страница не найдена');
        $bread = $category->getBread();
        $category->setSeo();
        if (count(request()->query())) {
            SEOMeta::setCanonical($category->url);
            $canonical = $category->url;
        } else {
            $canonical = null;
        }
        $categories = Catalog::public()->where('parent_id', 0)->get();

        $view = 'catalog.category';
        $page_n = request()->get('page') ?: 1;

        $per_page = request()->get('per_page');
        if (!$per_page) {
            $per_page = Settings::get('product_per_page') ?: 12;
        }
        $data['per_page'] = $per_page;

        $sort_by = \request()->get('sort_by') ?: 'name';
        $sort_direction = \request()->get('sort_direction') ?: 'asc';

        $items = $category->getRecurseProducts()
            ->orderBy($sort_by, $sort_direction)
            ->paginate($per_page);
        $count = $category->getRecurseProductsCount();

//        Auth::init();
//        if (Auth::user() && Auth::user()->isAdmin) {
//            View::share('admin_edit_link', route('admin.catalog.catalogEdit', [$category->id]));
//        }

        $data = [
            'bread' => $bread,
            'category' => $category,
            'canonical' => $canonical,
            'h1' => $category->getH1(),
            'categories' => $categories,
            'items' => $items,
            'count' => $count,
            'per_page' => $per_page,
            'page_n' => $page_n,
            'sort_by' => $sort_by,
            'sort_direction' => $sort_direction
        ];

        if (request()->ajax()) {
            $view_items = [];
            foreach ($items as $item) {
                $view_items[] = view('catalog.product_item', [
                    'item' => $item,
                    'category' => $category,
                    'per_page' => $per_page
                ])->render();
            }

            return response()->json([
                'items' => $view_items,
                'paginate' => view('catalog.section_pagination', [
                    'paginator' => $items,
                ])->render(),
            ]);
        }

        return view($view, $data);
    }

    public function product(Product $product) {
        $bread = $product->getBread();
//        $rawSimilarName = $product->name;
        $product->generateTitle();
        $product->generateDescription();
        $product->generateText();
        $product->setSeo();
        $categories = Catalog::public()->where('parent_id', 0)->get();

        $catalog = $product->catalog;
//        $root = $catalog;
//        while ($root->parent_id !== 0) {
//            $root = $root->findRootCategory($root->parent_id);
//        }

//        $relatedIds = $product->related()->get()->pluck('related_id'); //похожие товары добавленные из админки
//        $related = Product::whereIn('id', $relatedIds)->get();

        //наличие в корзине
//        $in_cart = false;
//        if (Session::get('cart')) {
//            $cart = array_keys(Session::get('cart'));
//            if ($cart) {
//                $in_cart = in_array($product->id, $cart);
//            }
//        }

        $images = $product->images;
//        $category_img = null;
//        if(!count($images)) {
//            $images = [];
//            $catalog = Catalog::whereId($product->catalog_id)->first();
//            $category_img = Catalog::UPLOAD_URL . $catalog->image;
//        }

//        $text = $product->text;
//        if($root->id == 1) {
//            $chars = $product->chars_text ?: $catalog->chars;
//        } else {
//            $chars = $product->chars;
//        }

//        $similarName = explode(' ', $rawSimilarName)[0];
//        $similar = Product::where('catalog_id', $product->catalog_id)
//            ->where('alias', '<>', $product->alias)
//            ->where('name', 'like', $similarName . '%')
//            ->get();
//        if (count($similar) > 10) {
//            $similar = $similar->random(10);
//        }

//        Auth::init();
//        if (Auth::user() && Auth::user()->isAdmin) {
//            View::share('admin_edit_link', route('admin.catalog.productEdit', [$product->id]));
//        }

        return view('catalog.product', [
            'product' => $product,
            'h1' => $product->getH1(),
            'category' => $catalog,
            'categories' => $categories,
            'bread' => $bread,
            'name' => $product->name,
            'images' => $images,
        ]);
    }

    public function search() {
        $see = Request::get('see', 'all');
        $products_inst = Product::query();
        if ($s = Request::get('search')) {
            $products_inst->where(function ($query) use ($s) {
                /** @var QueryBuilder $query */
                //сначала ищем точное совпадение с началом названия товара
                return $query->orWhere('name', 'LIKE',  $s . '%');
            });

            if (Request::ajax()) {
                //если нашлось больше 10 товаров, показываем их
                if($products_inst->count() >= 10) {
                    $products = $products_inst->limit(10)->get()->transform(function ($item) {
                        return [
                            'name' => $item->name . ' [' . $item->article . ']',
                            'url' => $item->url
                        ];
                    });
                } else {
                    //если меньше 10, разницу дополняем с совпадением по всему названию товара и артиклу
                    $count_before = $products_inst->count();
                    $sub = 10 - $count_before;
                    $adds_query = Product::query()
                        ->orWhere('name', 'LIKE', '%' . str_replace(' ', '%', $s) . '%')
                        ->orWhere('article', 'LIKE', '%' . str_replace(' ', '%', $s) . '%');
                    $adds_prod = $adds_query->limit($sub)->get();
                    $prods_before = $products_inst->limit($count_before)->get();
                    $all_prods = $prods_before->merge($adds_prod);
                    $products = $all_prods->transform(function ($item) {
                        return [
                            'name' => $item->name . ' [' . $item->article . ']',
                            'url' => $item->url
                        ];
                    });
                }
                return ['data' => $products];
            }

            if ($see == 'all' || !is_numeric($see)) {
                $products = $products_inst->paginate(Settings::get('search_per_page'));
            } else {
                $products = $products_inst->paginate($see);
                $filter_query = Request::only(['see', 'price', 'in_stock']);
                $filter_query = array_filter($filter_query);
                $products->appends($filter_query);
            }
        } else {
            $products = collect();
        }


        return view('search.index', [
            'items' => $products,
            'h1' => 'Поиск ' . $s,
            'title' => 'Результат поиска «' . $s . '»',
            'query' => $see,
            'name' => 'Поиск ' . $s,
            'keywords' => 'Поиск',
            'description' => 'Поиск',
        ]);
    }
}
