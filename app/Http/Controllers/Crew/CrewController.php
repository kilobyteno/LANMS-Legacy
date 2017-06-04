<?php namespace LANMS\Http\Controllers\Crew;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\Crew;
use LANMS\CrewCategory;
use LANMS\Page;

class CrewController extends Controller {

	public function __construct()
    {
        $this->middleware('csrf', ['only' => ['update', 'store']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$crewcategories = CrewCategory::where('active', '=', 1)->get();
		$pagesinmenu = Page::where('active', '=', 1)->where('showinmenu', '=', 1)->get(); // This needs to be included in all the frontend pages

		return view('crew.index')
					->with('crewcategories', $crewcategories)
					->with('pagesinmenu', $pagesinmenu);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function admin()
	{
		if (Sentinel::getUser()->hasAccess(['admin.crew.*'])){
			$crewassignment = Crew::all();
			return view('crew.admin')
						->with('crewassignment', $crewassignment);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (Sentinel::getUser()->hasAccess(['admin.crew.update'])){
			$crew = Crew::find($id);
			return view('crew.edit')->withCrew($crew);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
