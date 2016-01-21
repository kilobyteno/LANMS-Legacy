<?php namespace LANMS\Http\Controllers;

use LANMS\Page;

class HomeController extends Controller {

	public function index() {
		$pagesinmenu = Page::where('active', '=', 1)->where('showinmenu', '=', 1)->get();
		return view('home')->with('pagesinmenu', $pagesinmenu);
	}

}
