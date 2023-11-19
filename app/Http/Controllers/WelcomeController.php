<?php

namespace App\Http\Controllers;

use Adminlte3\Models\Catalog;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $mainSections = Catalog::whereParentId(0)->orderBy('order')->get();
        $mainSectionsStyles = [1 => 'hero__way--water', 2 => 'hero__way--gas'];
        return view('pages.index', compact(
            'mainSections',
            'mainSectionsStyles'
        ));
    }
}
