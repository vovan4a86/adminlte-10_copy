<?php namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\News;
use Adminlte3\Models\NewsCategory;
use Adminlte3\Models\NewsTag;
use Adminlte3\Models\Text;
use Adminlte3\Pagination;
use Barryvdh\Reflection\DocBlock\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AdminNewsController extends Controller {

	public function getIndex() {
        if (request()->user()->cannot('view')) {
            abort(403);
        }

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

        $news_categories = NewsCategory::pluck('name', 'id')->all();

		return view('adminlte::news.edit', [
            'article' => $article,
            'news_categories' => $news_categories,
        ]);
	}

	public function postSave() {
		$id = Request::input('id');
		$data = Request::only(['date', 'name', 'announce', 'news_category', 'text', 'published', 'alias', 'title', 'keywords', 'description']);
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

    public function postAddTag($id): array
    {
        $article = News::find($id);

        $name = request()->get('name');

        $tag = NewsTag::where('name', $name)->first();
        if (!$tag) {
            $tag = NewsTag::create(['name' => $name]);
        }
        $hasTags = $article->tags()->pluck('news_tag_id')->all();

        $item = null;
        if (!in_array($tag->id, $hasTags)) {
            $article->tags()->attach($tag);
            $item = view('adminlte::news.tag', ['tag' => $tag])->render();
        }

        return ['success' => true, 'item' => $item];
    }

    public function postDeleteTag(): array
    {
        $news_id = request()->get('news_id');
        $tag_id = request()->get('tag_id');

        $article = News::find($news_id);

        $article->tags()->detach($tag_id);

        return ['success' => true];
    }
}
