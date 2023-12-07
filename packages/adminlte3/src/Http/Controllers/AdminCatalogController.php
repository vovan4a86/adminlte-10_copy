<?php

namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\Catalog;
use Adminlte3\Models\CatalogFilter;
use Adminlte3\Models\ParentCatalogFilter;
use Adminlte3\Models\Product;
use Adminlte3\Models\ProductChar;
use Adminlte3\Models\ProductImage;
use Adminlte3\Models\Text;
use Adminlte3\Pagination;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @method getCatalogs()
 */
class AdminCatalogController extends Controller
{
    //catalog
    public function getIndex()
    {
        return view('adminlte::catalog.index');
    }

    public function getCatalogTree(): array
    {
        $catalogs = Catalog::where('parent_id', 0)->orderBy('order')->get();

        $result = [];
        foreach ($catalogs as $catalog) {
            $has_children = (bool)$catalog->children()->count();

            $result[] = [
                'title' => $catalog->name,
                'key' => $catalog->id,
                'folder' => $has_children,
                'href' => $catalog->url,
                'children' => $has_children ? $catalog->getChildren($catalog->id) : []
            ];
        }
        return $result;
    }

    public function getEdit($id = null)
    {
        return view(
            'adminlte::catalog.index',
            ['content' => $this->postEdit($id)]
        );
    }

    public function postEdit($id = null)
    {
        if (!$id || !($catalog = Catalog::findOrFail($id))) {
            $catalog = new Catalog;
            $catalog->parent_id = request()->get('parent', 0);
            $catalog->published = 1;
        }

        $catalogs_list = $this->getCatalogsRecurse();

        $catalogFiltersList = ParentCatalogFilter::where('catalog_id', $catalog->id)
            ->orderBy('order')
            ->get();

        return view(
            'adminlte::catalog.edit',
            [
                'catalog' => $catalog,
                'catalogs_list' => $catalogs_list,
                'catalogFiltersList' => $catalogFiltersList
            ]
        );
    }

    private function getCatalogsRecurse($parent_id = 0, $lvl = 0)
    {
        $result = [];
        $catalogs = Catalog::whereParentId($parent_id)->orderBy('order')->get();
        foreach ($catalogs as $catalog) {
            $result[$catalog->id] = str_repeat('&mdash;', $lvl) . $catalog->name;
            $result = $result + $this->getCatalogsRecurse($catalog->id, $lvl + 1);
        }

        return $result;
    }

    public function postSave(): array
    {
        $id = request()->get('id');
        $data = request()->except(['id', 'image']);
        $image = request()->file('image');

        $data['published'] = !Arr::get($data, 'published') ? 0 : 1;

        $catalog = Catalog::find($id);

        // Определяем правила валидации
        $rules = [
            'name' => 'required',
        ];

        // валидация данных
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        // Загружаем изображение
        if ($image) {
            $file_name = Catalog::uploadImage($image);
            $data['image'] = $file_name;
        }

        $check_alias = false;
        if (!$data['alias']) {
            $data['alias'] = Text::translit($data['name']);
            $check_alias = DB::table('catalogs')->where('alias', $data['alias'])->first();
        }

        // сохраняем страницу
        if (!$catalog) {
            if (!$data['title']) {
                $data['title'] = $data['name'];
            }
            $data['order'] = Catalog::where('parent_id', $data['parent_id'])->max('order') + 1;
            $catalog = Catalog::create($data);

            return ['redirect' => route('admin.catalog.edit', [$catalog->id])];
        } else {
            if ($catalog->parent_id != $data['parent_id']) {
                $data['order'] = Catalog::where('parent_id', $data['parent_id'])->max('order') + 1;
            }
            if ($catalog->image && isset($data['image'])) {
                $catalog->deleteImage();
            }
            $catalog->update($data);
        }
        if ($check_alias) {
            $catalog->alias = $catalog->id . '-' . $catalog->alias;
            $catalog->save();
        }

        return [
            'success' => true,
            'msg' => 'Изменения сохранены',
        ];
    }

    public function postDeleteImage($id): array
    {
        $catalog = Catalog::findOrFail($id);

        $catalog->deleteImage();
        $catalog->update(['image' => null]);

        return ['success' => true];
    }

    public function postReorder()
    {
        // изменение родителя
        $id = request()->get('id');
        $parent = request()->get('parent');
        DB::table('catalogs')->where('id', $id)->update(array('parent_id' => $parent));
        // сортировка
        $sorted = request()->get('sorted', []);
        foreach ($sorted as $order => $id) {
            DB::table('catalogs')->where('id', $id)->update(array('order' => $order));
        }

        return ['success' => true];
    }

    public function postDelete($id)
    {
        $catalog = Catalog::findOrFail($id);
        $catalog->delete();

        return ['success' => true];
    }

    public function postUpdateCatalogFilter(): array
    {
        $id = request()->get('id');

        if (!$id) {
            return ['success' => false, 'msg' => 'Ошибка, нет id'];
        }

        $item = ParentCatalogFilter::where('id', $id)->first();
        if ($item->published == 1) {
            $item->update(['published' => 0]);
        } else {
            $item->update(['published' => 1]);
        }

        return ['success' => true, 'msg' => 'Успешно обновлено!'];
    }

    //products
    public function getProducts($catalog_id)
    {
        $catalog = Catalog::findOrFail($catalog_id);

        return view(
            'adminlte::catalog.index',
            [
                'catalog' => $catalog,
                'content' => $this->postProducts($catalog_id)
            ]
        );
    }

    public function postProducts($catalog_id)
    {
        $per_page = Request::get('per_page');
        if (!$per_page) {
            $per_page = session('per_page', 50);
        }
        $catalog = Catalog::findOrFail($catalog_id);
        $products = $catalog->products()->orderBy('order');

        if ($q = Request::get('q')) {
            $products->where(
                function ($query) use ($q) {
                    $query->orWhere('name', 'LIKE', '%' . $q . '%');
                }
            );
        }

        $products = $products->paginate($per_page);
//        $products = Pagination::init($catalog->products()->orderBy('order'), 10)
//            ->get();
        $catalog_list = Catalog::getCatalogList();
        session(['per_page' => $per_page]);

        return view(
            'adminlte::catalog.products',
            [
                'catalog' => $catalog,
                'products' => $products,
                'catalog_list' => $catalog_list
            ]
        );
    }

    public function getProductEdit($id = null)
    {
        $catalogs = Catalog::orderBy('order')->get();

        return view(
            'adminlte::catalog.index',
            [
                'catalogs' => $catalogs,
                'content' => $this->postProductEdit($id)
            ]
        );
    }

    public function postProductEdit($id = null)
    {
        /** @var Product $product */
        if (!$id || !($product = Product::findOrFail($id))) {
            $product = new Product;
            $product->catalog_id = Request::get('catalog');
            $product->order = Product::whereCatalogId(Request::get('catalog'))->max('order') + 1;
            $product->published = 1;
            $product->in_stock = 1;
        }
        $catalogs_list = Catalog::getCatalogList();

        $data = [
            'product' => $product,
            'catalogs_list' => $catalogs_list,
        ];
        return view('adminlte::catalog.product_edit', $data);
    }

    public function postProductSave(): array
    {
        $id = Request::get('id');
        $data = Request::except(['id']);

        $data['alias'] = Arr::get($data, 'alias') ?: Text::translit($data['name']);
        $data['title'] = Arr::get($data, 'title') ?: $data['name'];
        $data['h1'] = Arr::get($data, 'h1') ?: $data['name'];
        $data['published'] = !Arr::get($data, 'published') ? 0 : 1;
        $data['in_stock'] = !Arr::get($data, 'in_stock') ? 0 : 1;

        $rules = [
            'name' => 'required',
        ];

        $rules['alias'] = $id
            ? 'required|unique:products,alias,' . $id . ',id,catalog_id,' . $data['catalog_id']
            : 'required|unique:products,alias,null,id,catalog_id,' . $data['catalog_id'];

        // валидация данных
        $validator = Validator::make(
            $data,
            $rules,
        );
        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        $redirect = false;

        // сохраняем страницу
        $product = Product::find($id);

        //сохраняем Характеристики
        $chars_data = Request::get('chars', []);
        $char_ids = Arr::get($chars_data, 'id', []);
        $char_names = Arr::get($chars_data, 'name', []);
        $char_values = Arr::get($chars_data, 'value', []);
        $chars_list = [];
        foreach ($char_ids as $key => $char_id) {
            $chars_list[] = [
                'id' => $char_id,
                'catalog_id' => $product->catalog_id,
                'product_id' => $product->id,
                'order' => $key,
                'name' => Arr::get($char_names, $key),
                'translit' => Text::translit(Arr::get($char_names, $key)),
                'value' => Arr::get($char_values, $key),
            ];
        }
        array_pop($chars_list);

        if (!$product) {
            $data['order'] = Product::where('catalog_id', $data['catalog_id'])->max('order') + 1;
            $product = Product::create($data);
            $redirect = true;
        } else {
            $product->update($data);
        }

        foreach ($chars_list as $key => $char) {
            $p = ProductChar::findOrNew(Arr::get($char, 'id'));
            if (!$p->id) {
                $redirect = false;
                $c = CatalogFilter::where('catalog_id', $product->catalog_id)
                    ->where('name', Arr::get($char, 'id'))->first();
                if (!$c) {
                    CatalogFilter::create(
                        [
                            'catalog_id' => $product->catalog_id,
                            'name' => Arr::get($char, 'name'),
                            'published' => 0,
                            'order' => CatalogFilter::where('catalog_id', $product->catalog_id)->max('order') + 1
                        ]
                    );
                }
            }
            $char['product_id'] = $product->id;
            $char['order'] = $key;
            $p->fill($char)->save();
        }

        return $redirect
            ? ['redirect' => route('admin.catalog.product-edit', [$product->id])]
            : ['success' => true, 'msg' => 'Изменения сохранены'];
    }

    public function postProductReorder(): array
    {
        $sorted = Request::input('sorted', []);
        foreach ($sorted as $order => $id) {
            DB::table('products')->where('id', $id)->update(array('order' => $order));
        }

        return ['success' => true];
    }

    public function postUpdateOrder($id): array
    {
        $order = Request::get('order');
        Product::whereId($id)->update(['order' => $order]);

        return ['success' => true];
    }

    public function postProductDelete($id): array
    {
        $product = Product::findOrFail($id);
        foreach ($product->images as $item) {
            $item->deleteImage();
            $item->delete();
        }
        $product->delete();

        return ['success' => true];
    }

    public function postProductImageUpload($product_id): array
    {
        $images = Request::file('images');
        $items = [];
        if ($images) {
            foreach ($images as $image) {
                $file_name = ProductImage::uploadImage($image);
                $order = ProductImage::where('product_id', $product_id)->max('order') + 1;
                $item = ProductImage::create(['product_id' => $product_id, 'image' => $file_name, 'order' => $order]);
                $items[] = $item;
            }
        }

        $html = '';
        foreach ($items as $item) {
            $html .= view('adminlte::catalog.product_image', ['image' => $item]);
        }

        return ['html' => $html];
    }

    public function postProductImageOrder(): array
    {
        $sorted = Request::get('sorted', []);
        foreach ($sorted as $order => $id) {
            ProductImage::whereId($id)->update(['order' => $order]);
        }

        return ['success' => true];
    }

    public function postProductImageDelete($id): array
    {
        /** @var ProductImage $item */
        $item = ProductImage::findOrFail($id);
        $item->deleteImage();
        $item->delete();

        return ['success' => true];
    }

    //product chars
    public function postProductAddChar($id): array
    {
        $data = request()->all();
        $rules = [
            'name' => 'required',
        ];

        // валидация данных
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        $char = ProductChar::where('product_id', $id)->where('name', trim($data['name']))->first();
        if ($char) {
            return ['errors' => 'Такая характеристика уже существует'];
        } else {
            $data['product_id'] = $id;
            $data['order'] = ProductChar::where('product_id', $id)->max('order') + 1;
            $char = ProductChar::create($data);

            $item = \view('adminlte::catalog.tab_chars.item', compact('char'))->render();

            return ['success' => true, 'item' => $item];
        }
    }

    public function postProductDelChar($id): array
    {
        $true = ProductChar::find($id)->delete();
        if (!$true) {
            return ['success' => false];
        }

        return ['success' => true];
    }

    public function postProductOrderChars(): array
    {
        $sorted = Request::get('sorted', []);
        foreach ($sorted as $order => $id) {
            ProductChar::whereId($id)->update(['order' => $order]);
        }

        return ['success' => true];
    }

    //mass
    public function postMoveProducts()
    {
        $catalog_id = Request::get('catalog_id');
        $item_ids = Request::get('items', []);
        if ($item_ids && $catalog_id) {
            Product::whereIn('id', $item_ids)
                ->update(['catalog_id' => $catalog_id]);
        }

        return ['success' => true];
    }

    public function postDeleteProducts()
    {
        $item_ids = Request::get('items', []);
        if ($item_ids) {
            $products = Product::whereIn('id', $item_ids)->get();
            foreach ($products as $product) {
                $product->deleteImage();
                $product->delete();
            }
        }

        return ['success' => true];
    }

    public function postDeleteProductsImage()
    {
        $item_ids = Request::get('items', []);
        if ($item_ids) {
            $products = Product::whereIn('id', $item_ids)->get();
            foreach ($products as $product) {
                $images = $product->images;

                if ($images) {
                    foreach ($images as $image) {
                        $image->deleteImage();
                        $image->delete();
                    }
                }
            }
        }

        return ['success' => true];
    }

    public function postSearch()
    {
        $q = Request::get('q');
        if (!$q) {
            $products = [];
        } else {
            $products = Product::query()->where(
                function ($query) use ($q) {
                    $query->orWhere('name', 'LIKE', '%' . $q . '%');
                }
            )->with('catalog')->paginate(50)->appends(['q' => $q]);
        }
        $catalogs = Catalog::orderBy('order')->get();
        $catalog_list = Catalog::getCatalogList();
        $content = view(
            'adminlte::catalog.search',
            compact('catalogs', 'catalog_list', 'products')
        )->render();
        return view(
            'adminlte::catalog.index',
            compact('content', 'catalogs')
        );
    }


}
