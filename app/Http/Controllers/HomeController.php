<?php

namespace LANMS\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use LANMS\News;
use LANMS\Page;
use LANMS\TicketType;

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
            $user = Sentinel::getUser();
            if ($user->theme == 'default' || $user->theme == 'light' || is_null($user->theme)) {
                $theme = 'dark';
            } else {
                $theme = 'default';
            }
            Sentinel::update($user, ['theme' => $theme]);
        }
        return redirect()->back();
    }

    public function schedule()
    {
        return view('main.schedule');
    }

    public function tickets()
    {
        $ticket_types = TicketType::where('active', true)->orderBy('price', 'asc')->get();
        return view('main.tickets', ['ticket_types' => $ticket_types]);
    }
}
