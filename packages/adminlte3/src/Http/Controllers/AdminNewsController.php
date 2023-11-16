<?php namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\News;
use Adminlte3\Models\Text;
use Adminlte3\Pagination;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AdminNewsController extends Controller {

	public function getIndex() {
        $news = Pagination::init(News::orderBy('date', 'desc'), 20)
            ->get();

        return view('adminlte::news.index', ['news' => $news]);
	}

	public function getEdit($id = null) {
		if (!$id || !($article = News::find($id))) {
			$article = new News;
			$article->date = date('Y-m-d');
			$article->published = 1;
		}

		return view('adminlte::news.edit', ['article' => $article]);
	}

	public function postSave() {
		$id = Request::input('id');
		$data = Request::only(['date', 'name', 'announce', 'text', 'published', 'alias', 'title', 'keywords', 'description']);
		$image = Request::file('image');

		if (!Arr::get($data, 'alias')) $data['alias'] = Text::translit($data['name']);
		if (!Arr::get($data, 'title')) $data['title'] = $data['name'];
        $data['published'] = !Arr::get($data, 'published') ? 0 : 1;

		// валидация данных
		$validator = Validator::make(
			$data,[
				'name' => 'required',
				'date' => 'required',
			]);
		if ($validator->fails()) {
			return ['errors' => $validator->messages()];
		}

		// Загружаем изображение
		if ($image) {
			$file_name = News::uploadImage($image);
			$data['image'] = $file_name;
		}

		// сохраняем страницу
		$article = News::find($id);
		$redirect = false;
		if (!$article) {
			$article = News::create($data);
			$redirect = true;
		} else {
			if ($article->image && isset($data['image'])) {
				$article->deleteImage();
			}
			$article->update($data);
		}

		if($redirect){
			return ['redirect' => route('admin.news.edit', [$article->id])];
		} else {
			return ['msg' => 'Изменения сохранены.'];
		}

	}

	public function postDelete($id) {
		$article = News::find($id);
		$article->delete();

		return ['success' => true];
	}

	public function postDeleteImage($id) {
		$news = News::find($id);
		if(!$news) return ['success' => false];

		$news->deleteImage();
		$news->update(['image' => null]);

		return ['success' => true];
	}
}
