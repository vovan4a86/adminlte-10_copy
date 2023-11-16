<?php namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\Review;
use Illuminate\Support\Arr;
use Request;
use Validator;
use DB;

class AdminReviewsController extends Controller {

	public function getIndex()
	{
		$reviews = Review::orderBy('order')->get();

		return view('adminlte::reviews.index', ['reviews' => $reviews]);
	}

	public function getEdit($id = null)
	{
		if (!$id || !($review = Review::findOrFail($id))) {
			$review = new Review;
			$review->published = 1;
		}

		return view('adminlte::reviews.edit', ['review' => $review]);
	}

	public function postSave()
	{
		$id = Request::input('id');
		$data = Request::except(['id']);

        $data['published'] = !Arr::get($data, 'published') ? 0 : 1;
        $data['on_main'] = !Arr::get($data, 'on_main') ? 0 : 1;
        \Debugbar::log($data);

		// валидация данных
		$validator = Validator::make(
		    $data,
		    [
		    	'name' => 'required',
		    ]
		);
		if ($validator->fails()) {
			return ['errors' => $validator->messages()];
		}

		// сохраняем страницу
		$review = Review::find($id);
		if (!$review) {
			$data['order'] = Review::max('order') + 1;
			$review = Review::create($data);
			return ['redirect' => route('admin.reviews.edit', [$review->id])];
		} else {
			$review->update($data);
		}

		return ['msg' => 'Изменения сохранены.'];
	}

	public function postReorder()
	{
		$sorted = Request::input('sorted', []);
		foreach ($sorted as $order => $id) {
			DB::table('reviews')->where('id', $id)->update(array('order' => $order));
		}
		return ['success' => true];
	}

	public function postDelete($id)
	{
		$review = Review::find($id);
		$review->delete();

		return ['success' => true];
	}
}
