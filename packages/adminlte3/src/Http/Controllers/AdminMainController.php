<?php

namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\AdminLog;
use Adminlte3\Models\Catalog;
use Adminlte3\Models\News;
use Adminlte3\Models\Product;
use Adminlte3\Models\Review;
use Adminlte3\Pagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminMainController extends Controller
{
    public function getIndex()
    {
        $logs = Pagination::init(AdminLog::orderBy('created_at', 'desc'), 30)
            ->get();
        $product_count = Product::public()->get()->count();
        $categories_count = Catalog::public()->get()->count();
        $news_count = News::public()->get()->count();
        $reviews_count = Review::public()->get()->count();

        return view(
            'adminlte::main',
            compact(
                'logs',
                'product_count',
                'categories_count',
                'news_count',
                'reviews_count'
            )
        );
    }

    public function getUsers()
    {
        $users = User::all();

        return view('adminlte::users.index', compact('users'));
    }
}
