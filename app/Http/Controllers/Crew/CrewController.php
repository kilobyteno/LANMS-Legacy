<?php namespace LANMS\Http\Controllers\Crew;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LANMS\CrewCategory;
use LANMS\Page;

class CrewController extends Controller {

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
		//
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
