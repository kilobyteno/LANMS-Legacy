<?php

namespace LANMS\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use LANMS\News;
use LANMS\Page;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::isPublished()->get()->take(5);
        return view('main.home')->withNews($news);
    }

    public function locale($locale)
    {
        if (\Sentinel::check()) {
            if (in_array($locale, array_keys(config('app.locales')))) {
                \Sentinel::update(\Sentinel::getUser(), ['language' => $locale]);
            }
        } else {
            if (in_array($locale, array_keys(config('app.locales')))) {
                \Session::put('locale', $locale);
            }
        }
        return redirect()->back();
    }

    public function theme()
    {
        if (Sentinel::check()) {
            if (Sentinel::getUser()->theme == 'default') {
                $theme = 'dark';
            } else {
                $theme = 'default';
            }
            Sentinel::update(Sentinel::getUser(), ['theme' => $theme]);
        }
        return redirect()->back();
    }

    public function schedule()
    {
        return view('main.schedule');
    }
}
