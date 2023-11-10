<?php

namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\Page;
use Adminlte3\Models\Setting;
use Adminlte3\Models\Text;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{

    public function getPages(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminlte::pages.index');
    }

    public function getEdit($id)
    {
        $page = Page::findOrFail($id);
        return view(
            'adminlte::pages.index',
            [
                'page' => $page,
                'content' => $this->postEdit($id)
            ]
        );
    }

    public function postEdit($id = null)
    {
        if (!$id || !($page = Page::findOrFail($id))) {
            $page = new Page;
            $page->parent_id = request()->get('parent', 1);
            $page->published = 1;
        }

        // Загружаем настройки, если есть
        $setting_groups = [];
        if ($page->id) {
            $setting_groups = $page->settingGroups ?? [];
        }

        $pages_list = $this->getPageRecurse();

        return view(
            'adminlte::pages.edit',
            [
                'page' => $page,
                'setting_groups' => $setting_groups,
                'pages_list' => $pages_list,
            ]
        );
    }

    private function getPageRecurse($parent_id = 0, $lvl = 0)
    {
        $result = [];
        $pages = Page::whereParentId($parent_id)->orderBy('order')->get();
        foreach ($pages as $page) {
            $result[$page->id] = str_repeat('&mdash;', $lvl) . $page->name;
            $result = $result + $this->getPageRecurse($page->id, $lvl + 1);
        }

        return $result;
    }

    public function getPagesTree(): array
    {
        $main_page = Page::where('parent_id', 0)->first();
        $has_children = (bool)$main_page->children()->count();

        $result = [];

        $result[] = [
            'title' => $main_page->name,
            'key' => $main_page->id,
            'folder' => $has_children,
            'href' => $main_page->url,
            'children' => $main_page->getChildren($main_page->id)
        ];

        return $result;
    }

    public function postSave(): array
    {
        $id = request()->get('id');
        $data = request()->except(['setting', 'setting_group']);

        $data = array_filter($data, function ($key) {
            return !Str::startsWith($key, 'setting_file_');
        }, ARRAY_FILTER_USE_KEY);
        $image = request()->file('image');

        $data['published'] = !Arr::get($data, 'published') ? 0 : 1;
        $data['on_header'] = !Arr::get($data, 'on_header') ? 0 : 1;
        $data['on_footer'] = !Arr::get($data, 'on_footer') ? 0 : 1;
        $data['on_mobile'] = !Arr::get($data, 'on_mobile') ? 0 : 1;


        $page = Page::find($id);

        // Определяем правила валидации
        $rules = [
            'name' => 'required',
        ];
        if ($page && $page->system == 0) {
            $rules['alias'] = 'required|unique:pages,alias,' . $page->id;
        } elseif (!$page && $data['alias']) {
            $rules['alias'] = 'required|unique:pages';
        }

        // валидация данных
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return ['errors' => $validator->messages()];
        }

        // Загружаем изображение
        if ($image) {
            $file_name = Page::uploadImage($image);
            $data['image'] = $file_name;
        }

        // сохраняем страницу
        if (!$page) {
            $check_alias = false;
            if (!$data['alias']) {
                $data['alias'] = Text::translit($data['name']);
                $check_alias = DB::table('pages')->where('alias', $data['alias'])->first();
            }
            if (!$data['title']) {
                $data['title'] = $data['name'];
            }
            $data['order'] = Page::where('parent_id', $data['parent_id'])->max('order') + 1;
            $page = Page::create($data);
            if ($check_alias) {
                $page->alias = $page->id . '-' . $page->alias;
                $page->save();
            }

            return ['redirect' => route('admin.pages.edit', [$page->id])];
        } else {
            if ($page->system == 1) {
                unset($data['alias']);
            }
            if ($page->parent_id != $data['parent_id']) {
                $data['order'] = Page::where('parent_id', $data['parent_id'])->max('order') + 1;
            }
            if ($page->image && isset($data['image'])) {
                $page->deleteImage();
            }
            $page->update($data);

            // сохраняем настройки
            $groups = request()->get('setting_group', []);
            if (!empty($groups)) {
                $settings_data = request()->get('setting', []);
                $settings = Setting::whereIn('group_id', $groups)->get();
                foreach ($settings as $setting) {
                    AdminSettingsController::settingSave($setting, Arr::get($settings_data, $setting->id));
                }
                if (!empty($_FILES)) {
                    return ['redirect' => route('admin.pages.edit', [$page->id])];
                }
            }
        }

        return [
            'success' => true,
            'msg' => 'Изменения сохранены',
        ];
    }

    public function postDeleteImage($id): array
    {
        $page = Page::findOrFail($id);

        $page->deleteImage();
        $page->update(['image' => null]);

        return ['success' => true];
    }

    public function postReorder() {
        // изменение родителя
        $id = request()->get('id');
        $parent = request()->get('parent');
        DB::table('pages')->where('id', $id)->update(array('parent_id' => $parent));
        // сортировка
        $sorted = request()->get('sorted', []);
        foreach ($sorted as $order => $id) {
            DB::table('pages')->where('id', $id)->update(array('order' => $order));
        }
        Debugbar::log($id);
        Debugbar::log($parent);
        Debugbar::log($sorted);

        return ['success' => true];
    }

    public function postDelete($id) {
        $page = Page::findOrFail($id);
        if ($page->system == 1) {
            return ['success' => false, 'msg' => 'Невозможно удалить системную страницу!'];
        }
        $page->delete();

        return ['success' => true];
    }

}
