<?php

namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\Catalog;
use Adminlte3\Models\Product;
use Adminlte3\Models\Text;
use Adminlte3\Pagination;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @method getCatalogs()
 */
class AdminCatalogController extends Controller
{

    public function getIndex()
    {
        $bread = [
            ['name' => 'Главная', 'url' => route('admin.index')],
            ['name' => 'Каталог', 'url' => route('admin.catalog.index')],
        ];

        return view('adminlte::catalog.index', compact('bread'));
    }

    public function getProducts($catalog_id)
    {
        return view(
            'adminlte::catalog.index',
            [
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
            'adminlte::catalog.main',
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
            $product = Product::create(
                [
                    'catalog_id' => Request::get('catalog'),
                    'order' => Product::whereCatalogId(Request::get('catalog'))->max('order') + 1,
                    'published' => 1,
                ]
            );
        }
        $catalogs = Catalog::getCatalogList();

        $data = [
            'product' => $product,
            'catalogs' => $catalogs,
        ];
        return view('adminlte::catalog.product_edit', $data);
    }

    public function getEdit($id)
    {
        $catalog = Catalog::findOrFail($id);
        return view(
            'adminlte::catalog.index',
            [
                'catalog' => $catalog,
                'content' => $this->postEdit($id)
            ]
        );
    }

    public function postEdit($id = null)
    {
        if (!$id || !($catalog = Catalog::findOrFail($id))) {
            $catalog = new Catalog;
            $catalog->parent_id = request()->get('parent', 1);
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

}
