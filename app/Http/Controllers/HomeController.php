<?php

namespace LANMS\Http\Controllers;

use LANMS\Page;
use LANMS\News;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::isPublished()->get()->take(4);
        return view('main.home')->withNews($news);
    }

    public function locale($locale)
    {
        $valid_locales = array('en', 'no');
        if (in_array($locale, $valid_locales)) {
            \Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}
