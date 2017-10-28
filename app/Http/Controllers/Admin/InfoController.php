<?php

namespace LANMS\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LANMS\Http\Controllers\Controller;

use LANMS\Info;

class InfoController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.info.*'])){
			$info = Info::all();
			return view('info.index')
						->withinfo($info);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (Sentinel::getUser()->hasAccess(['admin.info.update'])){
			$info = Info::find($id);
			return view('info.edit')->withContent($info->content);
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
	public function update($id, InfoEditRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.info.update'])){
			$info = Info::find($id);
			$info->content = $request->content;
			$info->save();

			return Redirect::route('admin-info')
					->with('messagetype', 'success')
					->with('message', 'The information has now been saved!');

		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}
}
