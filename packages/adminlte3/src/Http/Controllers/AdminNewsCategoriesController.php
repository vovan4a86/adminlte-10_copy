<?php namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\News;
use Adminlte3\Models\NewsCategory;
use Adminlte3\Models\Text;
use Adminlte3\Pagination;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AdminNewsCategoriesController extends Controller {

	public function getIndex() {
        $cats = NewsCategory::all();

        return view('adminlte::news_categories.index', ['cats' => $cats]);
	}

	public function getEdit($id = null) {
		if (!$id || !($category = NewsCategory::find($id))) {
            $category = new NewsCategory();
		}

		return view('adminlte::news_categories.edit', ['category' => $category]);
	}

	public function postSave(): array
    {
		$id = Request::input('id');
		$data = Request::only(['name', 'alias']);

		if (!Arr::get($data, 'alias')) $data['alias'] = Text::translit($data['name']);

		// валидация данных
		$validator = Validator::make(
			$data,['name' => 'required',]);
		if ($validator->fails()) {
			return ['errors' => $validator->messages()];
		}

		// сохраняем страницу
		$category = NewsCategory::find($id);
		$redirect = false;
		if (!$category) {
            $category = NewsCategory::create($data);
			$redirect = true;
		} else {
            $category->update($data);
		}

		if($redirect){
			return ['redirect' => route('admin.news-categories.edit', [$category->id])];
		} else {
			return ['msg' => 'Изменения сохранены.'];
		}

	}

	public function postDelete($id): array
    {
		$category = NewsCategory::find($id);
		$category->delete();

		return ['success' => true];
	}
}
