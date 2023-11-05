<?php

namespace Adminlte3\Http\Controllers;

use Adminlte3\Models\Page;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMainController extends Controller
{
    public function index()
    {
        return view('adminlte::main');
    }

    public function getEdit($id)
    {
        $page = Page::findOrFail($id);
        return view('adminlte::pages.index', [
            'page' => $page,
            'content' => $this->postEdit($id)
        ]);
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

    public function postEdit($id = null)
    {
        if (!$id || !($page = Page::findOrFail($id))) {
            $page = new Page;
            $page->parent_id = 0;
            $page->published = 1;
        }

        return view('adminlte::pages.edit', [
            'page' => $page,
        ]);
    }

    public function getAllUsers()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function getPages()
    {
//        $users = User::all();

//        $page = Page::find(1);
//
//        $ids = $this->getPagesTree();
//        dd($ids);

        return view('adminlte::pages.index');
    }

    public function profile()
    {
        $user = Auth::getUser();

        $username = $user ? $user->name : 'nobody';
        return view('admin.profile', compact('username'));
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

}
