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
        if (\Sentinel::guest()) {
            if (in_array($locale, array_keys(config('app.locales')))) {
                \Session::put('locale', $locale);
            }
        }
        return redirect()->back();
    }

    public function schedule()
    {
        return view('main.schedule');
    }
}
