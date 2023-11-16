<?php

namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\Catalog;
use Adminlte3\Models\Product;
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
        $catalogs = Catalog::where('parent_id', 0)->get();

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
            'adminlte::catalog.index', ['content' => $this->postEdit($id)]
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

        return view(
            'adminlte::catalog.edit',
            [
                'catalog' => $catalog,
                'catalogs_list' => $catalogs_list,
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
        if ($catalog && $catalog->system == 0) {
            $rules['alias'] = 'required|unique:catalogs,alias,' . $catalog->id;
        } elseif (!$catalog && $data['alias']) {
            $rules['alias'] = 'required|unique:catalogs';
        }

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

        // сохраняем страницу
        if (!$catalog) {
            $check_alias = false;
            if (!$data['alias']) {
                $data['alias'] = Text::translit($data['name']);
                $check_alias = DB::table('catalogs')->where('alias', $data['alias'])->first();
            }
            if (!$data['title']) {
                $data['title'] = $data['name'];
            }
            $data['order'] = Catalog::where('parent_id', $data['parent_id'])->max('order') + 1;
            $catalog = Catalog::create($data);
            if ($check_alias) {
                $catalog->alias = $catalog->id . '-' . $catalog->alias;
                $catalog->save();
            }

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
        $catalog = Catalog::findOrFail($catalog_id);
        $products = Pagination::init($catalog->products()->orderBy('order'), 20)
            ->get();

        return view(
            'adminlte::catalog.products',
            [
                'catalog' => $catalog,
                'products' => $products
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

//        $param_data = Request::get('params', []);
//        $param_ids = Arr::get($param_data, 'id', []);
//        $param_names = Arr::get($param_data, 'name', []);
//        $param_values = Arr::get($param_data, 'value', []);
//        $params = [];
//        foreach ($param_ids as $key => $param_id) {
//            $params[] = [
//                'id' => $param_id,
//                'name' => trim(Arr::get($param_names, $key)),
//                'value' => trim(Arr::get($param_values, $key)),
//            ];
//        }
//        array_pop($params);

        // сохраняем страницу
        $product = Product::find($id);
        if (!$product) {
            $data['order'] = Product::where('catalog_id', $data['catalog_id'])->max('order') + 1;
            $product = Product::create($data);
            $redirect = true;
        } else {
            $product->update($data);
        }

//        $start_update = Carbon::now();
//        foreach ($params as $key => $param) {
//            $p = ProductChar::findOrNew(array_get($param, 'id'));
//            if (!$p->id) {
//                $redirect = false;
//            }
//            $param['product_id'] = $product->id;
//            $param['order'] = $key;
//            $param['updated_at'] = $start_update;
//            $p->fill($param)->save();
//        }
//        ProductChar::whereProductId($product->id)
//            ->where('updated_at', '<', $start_update)
//            ->delete();

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

}
