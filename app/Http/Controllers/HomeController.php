<?php namespace LANMS\Http\Controllers;

use LANMS\News;

class HomeController extends Controller {

	public function index()
	{
		$news = News::isPublished()->get()->take(3);
		return view('home')
				  ->withNews($news);
	}

}
