<?php

namespace App\Http\Controllers;

use Adminlte3\Models\Catalog;
use Adminlte3\Models\Page;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $page = Page::find(1);
//        $page = $this->add_region_seo($page);
        $page->ogGenerate();
        $page->setSeo();

        $mainSections = Catalog::whereParentId(0)->orderBy('order')->get();
        $mainSectionsStyles = [1 => 'hero__way--water', 2 => 'hero__way--gas'];
        return view('pages.index', compact(
            'mainSections',
            'mainSectionsStyles'
        ));
    }
}
